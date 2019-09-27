<?php

namespace Erp\Http\Controllers\Apps;

use Illuminate\Http\Request;
use Erp\Http\Controllers\Controller;
use Erp\Models\Warehouse;
use Erp\Models\PaymentMethod;
use Erp\Models\PaymentTerm;
use Erp\Models\UomCategory;
use Erp\Models\UomValue;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class ConfigurationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Can View Data');
        $this->middleware('permission:Can Create Data', ['only' => ['create','store']]);
        $this->middleware('permission:Can Edit Data', ['only' => ['edit','update']]);
        $this->middleware('permission:Can Delete Data', ['only' => ['destroy']]);
    }

    public function warehouseIndex()
    {
        $data = Warehouse::orderBy('name','asc')->get();

        return view('apps.pages.warehouse',compact('data'));
    }

    public function warehouseStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:warehouses,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'created_by' => auth()->user()->id,
        ];
        $data = Warehouse::create($input);
        $log = 'Gudang '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Gudang '.($data->name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('warehouse.index')->with($notification);
    }

    public function warehouseEdit($id)
    {
        $data = Warehouse::find($id);

        return view('apps.edit.warehouse',compact('data'))->renderSections()['content'];
    }

    public function warehouseUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:warehouses,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = Warehouse::find($id)->update($input);
        $log = 'Gudang '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Gudang '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('warehouse.index')->with($notification);
    }

    public function warehouseDestroy($id)
    {
        $data = Warehouse::find($id);
        $log = 'Gudang '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Gudang '.($data->name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('warehouse.index')->with($notification);
    }

    public function methodIndex()
    {
        $data = PaymentMethod::orderBy('name','asc')->get();

        return view('apps.pages.paymentMethod',compact('data'));
    }

    public function methodStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:payment_methods,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'created_by' => auth()->user()->id,
        ];
        $data = PaymentMethod::create($input);
        $log = 'Metode Pembayaran '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Metode Pembayaran '.($data->name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('pay-method.index')->with($notification);
    }

    public function methodEdit($id)
    {
        $data = PaymentMethod::find($id);

        return view('apps.edit.paymentMethod',compact('data'))->renderSections()['content'];
    }

    public function methodUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:payment_methods,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = PaymentMethod::find($id)->update($input);
        $log = 'Metode Pembayaran '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Metode Pembayaran '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('pay-method.index')->with($notification);
    }

    public function methodDestroy($id)
    {
        $data = PaymentMethod::find($id);
        $log = 'Metode Pembayaran '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Metode Pembayaran '.($data->name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('pay-method.index')->with($notification);
    }

    public function termIndex()
    {
        $data = PaymentTerm::orderBy('name','asc')->get();

        return view('apps.pages.paymentTerm',compact('data'));
    }

    public function termStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:payment_terms,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'created_by' => auth()->user()->id,
        ];
        $data = PaymentTerm::create($input);
        $log = 'Pembayaran '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Pembayaran '.($data->name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('pay-term.index')->with($notification);
    }

    public function termEdit($id)
    {
        $data = PaymentTerm::find($id);

        return view('apps.edit.paymentTerm',compact('data'))->renderSections()['content'];
    }

    public function termUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:payment_terms,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = PaymentTerm::find($id)->update($input);
        $log = 'Pembayaran '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Pembayaran '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('pay-term.index')->with($notification);
    }

    public function termDestroy($id)
    {
        $data = PaymentTerm::find($id);
        $log = 'Pembayaran '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Pembayaran '.($data->name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('pay-term.index')->with($notification);
    }

    public function uomcatIndex()
    {
        $data = UomCategory::orderBy('name','asc')->get();

        return view('apps.pages.uomCategory',compact('data'));
    }

    public function uomcatStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:uom_categories,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'created_by' => auth()->user()->id,
        ];
        $data = UomCategory::create($input);
        $log = 'Kategori UOM '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori UOM '.($data->name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('uom-cat.index')->with($notification);
    }

    public function uomcatEdit($id)
    {
        $data = UomCategory::find($id);

        return view('apps.edit.uomCategory',compact('data'))->renderSections()['content'];
    }

    public function uomcatUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:uom_categories,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = UomCategory::find($id)->update($input);
        $log = 'Kategori UOM '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori UOM '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('uom-cat.index')->with($notification);
    }

    public function uomcatDestroy($id)
    {
        $data = UomCategory::find($id);
        $log = 'Kategori UOM '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori UOM '.($data->name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('uom-cat.index')->with($notification);
    }

    public function uomvalIndex()
    {
        $data = UomValue::orderBy('created_at','asc')->get();
        $categories = UomCategory::pluck('name','id')->toArray();
        $parents = UomValue::where('is_parent','1')->pluck('name','id')->toArray();

        return view('apps.pages.uomValue',compact('data','categories','parents'));
    }

    public function uomvalStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:uom_values,name',
            'type_id' => 'required',
            'value' => 'required|numeric',
        ]);

        $input = [
            'name' => $request->input('name'),
            'type_id' => $request->input('type_id'),
            'is_parent' => $request->input('is_parent'),
            'parent_id' => $request->input('parent_id'),
            'value' => $request->input('value'),
            'created_by' => auth()->user()->id,
        ];
        $data = UomValue::create($input);
        $log = 'UOM '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'UOM '.($data->name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('uom-val.index')->with($notification);
    }

    public function uomvalEdit($id)
    {
        $data = UomValue::find($id);
        $categories = UomCategory::pluck('name','id')->toArray();

        return view('apps.edit.uomValue',compact('data','categories'))->renderSections()['content'];
    }

    public function uomvalUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:uom_values,name',
            'type_id' => 'required',
            'value' => 'required|numeric',
        ]);

        $input = [
            'name' => $request->input('name'),
            'type_id' => $request->input('type_id'),
            'value' => $request->input('value'),
            'updated_by' => auth()->user()->id,
        ];
        $data = UomValue::find($id)->update($input);
        $log = 'UOM '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'UOM '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('uom-val.index')->with($notification);
    }

    public function uomvalDestroy($id)
    {
        $data = UomValue::find($id);
        $log = 'UOM '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'UOM '.($data->name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('uom-val.index')->with($notification);
    }
}
