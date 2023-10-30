<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Warehouse;
use iteos\Models\Location;
use iteos\Models\PaymentMethod;
use iteos\Models\PaymentTerm;
use iteos\Models\UomCategory;
use iteos\Models\UomValue;
use iteos\Models\DeliveryService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class ConfigurationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Can Access Settings');
        $this->middleware('permission:Can Create Setting', ['only' => ['create','store']]);
        $this->middleware('permission:Can Edit Setting', ['only' => ['edit','update']]);
        $this->middleware('permission:Can Delete Setting', ['only' => ['destroy']]);
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
            'created_by' => auth()->user()->name,
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
            'updated_by' => auth()->user()->name,
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

    public function locationIndex()
    {
        $data = Location::orderBy('location_name','asc')->get();
        $warehouses = Warehouse::orderBy('name','asc')->pluck('name','id')->toArray();

        return view('apps.pages.location',compact('data','warehouses'));
    }

    public function locationStore(Request $request)
    {
        $this->validate($request, [
            'location_name' => 'required|unique:locations,location_name',
            'location_detail' => 'required',
            'warehouse_id' => 'required'
        ]);

        $input = [
            'location_name' => $request->input('location_name'),
            'warehouse_id' => $request->input('warehouse_id'),
            'location_detail' => $request->input('location_detail'),
            'created_by' => auth()->user()->name,
        ];
        $data = Location::create($input);
        $log = 'Lokasi '.($data->location_name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Lokasi '.($data->location_name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('location.index')->with($notification);
    }

    public function locationEdit($id)
    {
        $data = Location::find($id);
        $warehouses = Warehouse::orderBy('name','asc')->pluck('name','id')->toArray();

        return view('apps.edit.location',compact('data','warehouses'))->renderSections()['content'];
    }
    public function locationUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'location_name' => 'required',
            'location_detail' => 'required',
            'warehouse_id' => 'required'
        ]);

        $input = [
            'location_name' => $request->input('location_name'),
            'warehouse_id' => $request->input('warehouse_id'),
            'location_detail' => $request->input('location_detail'),
            'updated_by' => auth()->user()->name,
        ];
        $data = Location::find($id)->update($input);
        $log = 'Lokasi '.($data->location_name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Lokasi '.($data->location_name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('location.index')->with($notification);
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
            'created_by' => auth()->user()->name,
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
            'updated_by' => auth()->user()->name,
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
            'created_by' => auth()->user()->name,
        ];
        $data = PaymentTerm::create($input);
        $log = 'Termin Pembayaran '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Termin Pembayaran '.($data->name).' Berhasil Disimpan',
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
            'updated_by' => auth()->user()->name,
        ];
        $data = PaymentTerm::find($id)->update($input);
        $log = 'Termin Pembayaran '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Termin Pembayaran '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('pay-term.index')->with($notification);
    }

    public function termDestroy($id)
    {
        $data = PaymentTerm::find($id);
        $log = 'Termin Pembayaran '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Termin Pembayaran '.($data->name).' Berhasil Dihapus',
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
            'created_by' => auth()->user()->name,
        ];
        $data = UomCategory::create($input);
        $log = 'Kategori Satuan '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori Satuan '.($data->name).' Berhasil Disimpan',
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
            'updated_by' => auth()->user()->name,
        ];
        $data = UomCategory::find($id)->update($input);
        $log = 'Kategori Satuan '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori Satuan '.($data->name).' Berhasil Diubah',
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
            'message' => 'Kategori Satuan '.($data->name).' Berhasil Dihapus',
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
            'created_by' => auth()->user()->name,
        ];
        $data = UomValue::create($input);
        $log = 'Satuan '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Satuan '.($data->name).' Berhasil Disimpan',
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
            'updated_by' => auth()->user()->name,
        ];
        $data = UomValue::find($id)->update($input);
        $log = 'Satuan '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Satuan '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('uom-val.index')->with($notification);
    }

    public function uomvalDestroy($id)
    {
        $data = UomValue::find($id);
        $log = 'Satuan '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Satuan '.($data->name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('uom-val.index')->with($notification);
    }

    public function deliveryServiceIndex()
    {
        $data = DeliveryService::orderBy('created_at','ASC')->get();
        
        return view('apps.pages.deliveryService',compact('data'));
    }

    public function deliveryServiceStore(Request $request)
    {
        $this->validate($request, [
            'delivery_name' => 'required|unique:delivery_services,delivery_name',
        ]);

        $input = [
            'delivery_name' => $request->input('delivery_name'),
            'created_by' => auth()->user()->name,
        ];

        $data = DeliveryService::create($input);
        $log = 'Jasa Pengiriman '.($data->delivery_name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Jasa Pengiriman '.($data->delivery_name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('delivery-service.index')->with($notification);
    }

    public function deliveryServiceEdit($id)
    {
        $data = DeliveryService::find($id);
        
        return view('apps.edit.deliveryService',compact('data'))->renderSections()['content'];
    }

    public function deliveryServiceUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'delivery_name' => 'required',
        ]);

        $data = DeliveryService::find($id);
        $data->update([
            'delivery_name' => $request->input('delivery_name'),
            'updated_by' => auth()->user()->name,
        ]);

        $log = 'Jasa Pengiriman '.($data->delivery_name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Jasa Pengiriman '.($data->delivery_name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('delivery-service.index')->with($notification);
    }

    public function deliveryServiceDelete($id)
    {
        $data = DeliveryService::find($id);
        
        $log = 'Jasa Pengiriman '.($data->delivery_name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Jasa Pengiriman '.($data->delivery_name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('delivery-service.index')->with($notification);
    }
}
