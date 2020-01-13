<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Sale;
use iteos\Models\SaleItem;
use iteos\Models\Purchase;
use iteos\Models\PurchaseItem;
use iteos\Models\Payment;
use iteos\Models\Delivery;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use PDF;

class PaymentManagementController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Can Access Finances');
         $this->middleware('permission:Can Create Finance', ['only' => ['create','store']]);
         $this->middleware('permission:Can Edit Finance', ['only' => ['edit','update']]);
         $this->middleware('permission:Can Delete Finance', ['only' => ['destroy']]);
    }

    public function invoiceIndex()
    {
        $orders = Sale::where('status_id','458410e7-384d-47bc-bdbe-02115adc4449')->pluck('order_ref','id')->toArray();
        $data = Payment::where('type_id','1')->get(); 
        return view('apps.pages.invoices',compact('data','orders'));
    }

    public function invoiceStore(Request $request) 
    {
        $latestRef = Payment::where('type_id','1')->count();
        $getClient = Sale::where('id',$request->input('sales_order'))->first();
        $refs = 'INV/FTI/'.str_pad($latestRef + 1, 4, "0", STR_PAD_LEFT).'/'.($getClient->client_code).'/'.(\GenerateRoman::integerToRoman(Carbon::now()->month)).'/'.(Carbon::now()->year).''; 
        $invoices = Payment::create([
            'reference_id' => $refs,
            'type_id' => '1',
            'sales_order' => $request->input('sales_order'),
            'created_by' => auth()->user()->name,
        ]);
        $process = Sale::where('id',$invoices->sales_order)->update([
            'status_id' => '3da32f6e-494f-4b61-b010-7ccc0e006fb3',
        ]);

        $log = 'Invoice '.($invoices->refs).' Berhasil Dibuat';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Invoice '.($invoices->refs).' Berhasil Dibuat',
            'alert-type' => 'success'
        );
        
        return redirect()->route('invoice.index')->with($notification);
    }

    public function invoicePayment(Request $request,$id)
    {
        $invoices = Payment::find($id);
        $payment = $invoices->update([
            'status_id' => 'eca81b8f-bfb9-48b9-8e8d-86f4517bc129',
            'updated_by' => auth()->user()->name,
            'payment_received' => Carbon::now(),
        ]);
        $process = Sale::where('id',$invoices->sales_order)->update([
            'status_id' => 'eca81b8f-bfb9-48b9-8e8d-86f4517bc129',
        ]);
        $log = 'Invoice '.($invoices->refs).' Berhasil Dibayar';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Invoice '.($invoices->refs).' Berhasil Dibayar',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function invoiceShow($id)
    {
        $source = Payment::find($id);
        $sales = Sale::where('id',$source->sales_order)
                        ->first();   
        $items = SaleItem::where('sales_id',$sales->order_ref)
                        ->get();
        
        return view('apps.print.invoice',compact('source','sales','items'));
    }

    public function invoicePrint($id)
    {
        $source = Payment::find($id);
        $sales = Sale::join('deliveries','deliveries.order_ref','sales.order_ref')
                        ->where('sales.id',$source->sales_order)
                        ->first();   
        
        $items = SaleItem::where('sales_id',$source->sales_order)
                        ->get();
        
        $filename = $source->reference_id;
        $pdf = PDF::loadview('apps.print.invoice',compact('source','sales','items'))
                    ->setPaper('a4','portrait');
        return $pdf->download(''.$filename.'.pdf');
    }

    public function salesPrint($id) 
    {
        $sales = Sale::find($id);
        $data = SaleItem::where('sales_id',$id)->get();

        $pdf = PDF::loadview('apps.print.sales',compact('data','sales'));
        return $pdf->download('SO.pdf');
    }

    public function receiptIndex()
    {
        $data = Payment::where('type_id','2')->get();
        $orders = Purchase::where('status','458410e7-384d-47bc-bdbe-02115adc4449')->pluck('order_ref','id')->toArray();

        return view('apps.pages.purchasePayment',compact('data','orders'));
    }

    public function receiptStore(Request $request)
    {
        $this->validate($request,[
            'purchase_order' => 'required',
            'purchase_amount' => 'required|numeric',
            'purchase_invoice' => 'required|file|mimes:pdf,PDF',
        ]);
        $uploadedFile = $request->file('purchase_invoice');
        $path = $uploadedFile->store('purchase'); 
        $latestRef = Payment::where('type_id','2')->count();
        $getClient = Purchase::where('id',$request->input('purchase_order'))->first();
        $refs = 'FIN/FTI/'.str_pad($latestRef + 1, 4, "0", STR_PAD_LEFT).'/'.($getClient->supplier_code).'/'.(\GenerateRoman::integerToRoman(Carbon::now()->month)).'/'.(Carbon::now()->year).''; 
        $invoices = Payment::create([
            'reference_id' => $refs,
            'type_id' => '2',
            'purchase_order' => $request->input('purchase_order'),
            'purchase_amount' => $request->input('purchase_amount'),
            'purchase_invoice' => $path,
            'status_id' => '106da5a6-2c71-4a08-9342-db3fd8ebf71e',
            'created_by' => auth()->user()->name,
        ]);
        
        $log = 'Pembayaran '.($invoices->refs).' Berhasil Dibuat';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Pembayaran '.($invoices->refs).' Berhasil Dibuat',
            'alert-type' => 'success'
        );
        
        return redirect()->route('purchaseReceipt.index')->with($notification);
    }

    public function receiptPayment(Request $request,$id)
    {
        $invoices = Payment::find($id);
        $payment = $invoices->update([
            'status_id' => 'd6c23804-3b9b-40ca-b050-146af5594f5d',
            'updated_by' => auth()->user()->name,
            'payment_made' => Carbon::now(),
        ]);
        
        $log = 'Pembayaran '.($invoices->refs).' Berhasil Dibayar';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Pembayaran '.($invoices->refs).' Berhasil Dibayar',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function receiptShow($id)
    {
        $source = Payment::find($id);
        $purchases = Purchase::where('id',$source->order_ref)
                        ->first();   
        $items = PurchaseItem::where('purchase_id',$purchases->id)
                        ->get();
        
        return view('apps.show.purchaseReceipt',compact('source','purchases','items'));
    }

    public function receiptPrint($id)
    {
        $source = Payment::find($id);
        $purchases = Purchase::where('id',$source->order_ref)
                        ->first();   
        $items = PurchaseItem::where('purchase_id',$purchases->id)
                        ->get();
        
        $filename = $source->order_ref;
        $pdf = PDF::loadview('apps.print.purchaseReceipt',compact('source','purchases','items'))
                    ->setPaper('a4','portrait');
        return $pdf->download(''.$filename.'.pdf');
    }
}
