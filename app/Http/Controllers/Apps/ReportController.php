<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Product;
use iteos\Models\ProductMovement;
use iteos\Models\Location;
use iteos\Models\Warehouse;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use DB;

class ReportController extends Controller
{
    public function movementIndex()
    {
        $products = Product::all();

        return view('apps.pages.movementIndex',compact('products'));
    }

    public function movementProcess(Request $request)
    {
        
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $item = $request->input('asset');

        if($start == null && $end == null) {
            $data = ProductMovement::where('product_id',$item)->get();  
        }elseif($item == null) {
            $data = ProductMovement::with('parent','locations','branches')
                                    ->where('created_at','>=',$start)
                                    ->where('created_at','<=',$end)
                                    ->get();
        }else{
            $data = ProductMovement::with('parent','locations','branches')
                                    ->where('product_id',$item)
                                    ->where('created_at','>=',$start)
                                    ->where('created_at','<=',$end)
                                    ->get();
        }

        return view('apps.reports.movementItem',compact('data'));
    }
    
    public function auditIndex()
    {
        $locations = Location::where('deleted_at',NULL)->get();
        $branches = Warehouse::where('deleted_at',NULL)->get(); 
        return view('apps.pages.auditIndex',compact('locations','branches'));
    }

    public function auditGenerate(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required|after:start_date',
        ]);

        $branch = $request->input('branch');
        $location = $request->input('location');
        
        if($branch == null && $location == null) {
            
            $data = Product::with('branches','locations')
                            ->join('tag_device_audits','tag_device_audits.sap_code','products.sap_code')
                            ->where('tag_device_audits.created_at','>=',$request->input('start_date'))
                            ->where('tag_device_audits.created_at','<=',$request->input('end_date'))
                            ->select('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                            ->groupBy('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                            ->get();
                    
            return view('apps.show.audit',compact('data'));
        } elseif ($branch == null) {
            $data = Product::with('branches','locations')
                        ->join('tag_device_audits','tag_device_audits.sap_code','products.sap_code')
                        ->where('tag_device_audits.audit_location',$location)
                        ->where('tag_device_audits.created_at','>=',$request->input('start_date'))
                        ->where('tag_device_audits.created_at','<=',$request->input('end_date'))
                        ->select('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->groupBy('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->get();
            
            return view('apps.show.audit',compact('data'));
        } elseif ($location == null) {
            $data = Product::with('branches','locations')
                        ->join('tag_device_audits','tag_device_audits.sap_code','products.sap_code')
                        ->where('tag_device_audits.audit_branch',$branch)
                        ->where('tag_device_audits.created_at','>=',$request->input('start_date'))
                        ->where('tag_device_audits.created_at','<=',$request->input('end_date'))
                        ->select('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->groupBy('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->get();
            
            return view('apps.show.audit',compact('data'));
        } else {
            $data = Product::with('branches','locations')
                        ->join('tag_device_audits','tag_device_audits.sap_code','products.sap_code')
                        ->where('tag_device_audits.audit_branch',$branch)
                        ->where('tag_device_audits.audit_location',$location)
                        ->where('tag_device_audits.created_at','>=',$request->input('start_date'))
                        ->where('tag_device_audits.created_at','<=',$request->input('end_date'))
                        ->select('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->groupBy('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->get();
            
            return view('apps.show.audit',compact('data'));
        }
    }
}
