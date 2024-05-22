<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Warehouse;
use iteos\Models\Location;
use iteos\Models\Division;
use iteos\Exports\BranchExport;
use iteos\Exports\DivisionExport;
use iteos\Exports\LocationExport;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Carbon\Carbon;

class ConfigurationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Can Access Settings');
        $this->middleware('permission:Can Create Data', ['only' => ['create','store']]);
        $this->middleware('permission:Can Edit Data', ['only' => ['edit','update']]);
        $this->middleware('permission:Can Delete Data', ['only' => ['destroy']]);
    }

    public function warehouseIndex()
    {
        $data = Warehouse::orderBy('id','asc')->get();

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
        $log = 'Branch '.($data->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Branch '.($data->name).' Created',
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
        $data = Warehouse::find($id);
        $data->update($input);
        $log = 'Branch '.($data->name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Branch '.($data->name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('warehouse.index')->with($notification);
    } 

    public function warehouseDestroy($id)
    {
        $data = Warehouse::find($id);
        $destroy = [
            'deleted_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => auth()->user()->id,
        ];
        $log = 'Branch '.($data->name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Branch '.($data->name).' Deleted',
            'alert-type' => 'success'
        );
        $data->update($destroy);

        return redirect()->route('warehouse.index')->with($notification);
    }

    public function warehouseExport()
    {
        return Excel::download(new BranchExport, 'branch.xlsx');
    }

    public function locationIndex()
    {
        $data = Location::where('sap_id','!=','1')->where('sap_id','!=','2')->where('sap_id','!=','3')->orderBy('id','asc')->get();
        $warehouses = Warehouse::where('deleted_at',NULL)->get();

        return view('apps.pages.location',compact('data','warehouses')); 
    }

    public function locationStore(Request $request)
    {
        $this->validate($request, [
            'sap_id' => 'required|unique:locations,sap_id',
            'location_name' => 'required|unique:locations,location_name',
            'warehouse_id' => 'required'
        ]);

        $input = [
            'sap_id' => $request->input('sap_id'),
            'location_name' => $request->input('location_name'),
            'warehouse_id' => $request->input('warehouse_id'),
            'location_detail' => $request->input('location_detail'),
            'created_by' => auth()->user()->id,
        ];
        $data = Location::create($input);
        $log = 'Location '.($data->location_name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Location '.($data->location_name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('location.index')->with($notification);
    }

    public function locationEdit($id)
    {
        $data = Location::find($id);
        $warehouses = Warehouse::where('deleted_at',NULL)->pluck('name','id')->toArray();

        return view('apps.edit.location',compact('data','warehouses'))->renderSections()['content'];
    }
    public function locationUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'sap_id' => 'required',
            'location_name' => 'required',
            'warehouse_id' => 'required'
        ]);

        $input = [
            'sap_id' => $request->input('sap_id'),
            'location_name' => $request->input('location_name'),
            'warehouse_id' => $request->input('warehouse_id'),
            'location_detail' => $request->input('location_detail'),
            'updated_by' => auth()->user()->id,
        ];
        $data = Location::find($id)->update($input);
        $log = 'Location '.($data->location_name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Location '.($data->location_name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('location.index')->with($notification);
    }

    public function locationDestroy($id)
    {
        $data = Location::find($id);
        $destroy = [
            'deleted_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => auth()->user()->id,
        ];
        $log = 'Location '.($data->location_name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Location '.($data->location_name).' Deleted',
            'alert-type' => 'success'
        );
        $data->update($destroy);

        return redirect()->route('warehouse.index')->with($notification);
    }

    public function locationExport()
    {
        return Excel::download(new LocationExport, 'location.xlsx');
    }

    public function ukerIndex()
    {
        $units = Division::orderBy('id','ASC')->get();
        return view('apps.pages.units',compact('units'));
    }

    public function ukerStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:divisions,name',
            'prefix' => 'required|unique:divisions,prefix',
        ]);

        $input = [
            'name' => $request->input('name'),
            'prefix' => $request->input('prefix'),
            'created_by' => auth()->user()->id,
        ];
        
        $data = Division::create($input);
        $log = 'Department '.($data->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Department '.($data->name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('dept.index')->with($notification);  
    }

    public function ukerEdit($id)
    {
        $data = Division::find($id);
        return view('apps.edit.units',compact('data'))->renderSections()['content'];
    }
    public function ukerUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:divisions,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = Division::find($id);
        $log = 'Department '.($data->name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Department '.($data->name).' Updated',
            'alert-type' => 'success'
        );
        $data->update($input);

        return redirect()->route('dept.index')->with($notification);
    }

    public function ukerDestroy($id)
    {
        $data = Division::find($id);
        $destroy = [
            'deleted_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => auth()->user()->id,
        ];
        $log = 'Department '.($data->name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Department '.($data->name).' Deleted',
            'alert-type' => 'success'
        );
        $data->update($destroy);
        return redirect()->route('dept.index')->with($notification);
    }

    public function ukerExport()
    {
        return Excel::download(new DivisionExport, 'department.xlsx');
    }
}