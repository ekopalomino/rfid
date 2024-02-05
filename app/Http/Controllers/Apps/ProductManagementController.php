<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Product;
use iteos\Models\ProductCategory;
use iteos\Models\Location;
use iteos\Models\Division;
use iteos\Models\Warehouse;
use iteos\Models\ProductMovement;
use iteos\Models\Warranty;
use iteos\Imports\ProductImport;
use iteos\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use PDF;
use File;
use DB;
use Storage;
use DataTables;
use Carbon\Carbon;

class ProductManagementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Can Access Asset');
        $this->middleware('permission:Can Create Asset', ['only' => ['create','store']]);
        $this->middleware('permission:Can Edit Asset', ['only' => ['edit','update']]);
        $this->middleware('permission:Can Delete Asset', ['only' => ['destroy']]);
    }

    public function categoryIndex()
    {
        $data = ProductCategory::orderBy('name','asc')->get();

        return view('apps.pages.productCategory',compact('data'));
    }

    public function categoryStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:product_categories,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'created_by' => auth()->user()->id,
        ];
        $data = ProductCategory::create($input);
        $log = 'Asset Category '.($data->name).' Successfully Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset Category '.($data->name).' Successfully Created',
            'alert-type' => 'success'
        );

        return redirect()->route('product-cat.index')->with($notification);
    }

    public function categoryEdit($id)
    {
        $data = ProductCategory::find($id);

        return view('apps.edit.productCategory',compact('data'))->renderSections()['content'];
    }

    public function categoryUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:product_categories,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = ProductCategory::find($id);
        $data->update($input);
        $log = 'Asset Category '.($data->name).' Successfully Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset Category '.($data->name).' Successfully Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('product-cat.index')->with($notification);
    }

    public function categoryDestroy($id)
    {
        $data = ProductCategory::find($id);
        $destroy = [
            'deleted_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => auth()->user()->id,
        ];
        $log = 'Asset Category '.($data->name).' Successfully Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset Category '.($data->name).' Successfully Deleted',
            'alert-type' => 'success'
        );
        $data->update($destroy);

        return redirect()->route('product-cat.index')->with($notification);
    }

    public function getProductTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('Author','Categories','Branches','Departments','Locations')->where('deleted_at',NULL)->orderBy('name','ASC');

            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('categories',function(Product $product){
                    return $product->categories->name;
                })
                ->addColumn('branches',function(Product $product){
                    return $product->branches->name;
                })
                ->addColumn('locations',function(Product $product){
                    return $product->locations->location_name;
                })
                ->addColumn('statuses',function($row){
                    if($row->deleted_at == NULL){
                        return "Active";
                    }else{
                        return "Inactive";
                    }
                })
                ->addColumn('author',function(Product $product){
                    return $product->author->name;
                })
                ->addColumn('created_at',function($row){
                    $date = date("d F Y H:i", strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('action', function($row){
                    // Update Button
                    $updateButton = "<a class='btn btn-xs btn-info updateProduct' href='".route('asset.edit',$row->id)."'' ><i class='fa fa-edit'></i></a>";
                    // Delete Button
                    $deleteButton = "<button class='btn btn-xs btn-danger deleteProduct' data-id='".$row->id."'><i class='fa fa-trash'></i></button>";

                    return $updateButton." ".$deleteButton;

                }) 
                ->make();
        }
        return view('apps.pages.products');
        
    }

    public function productCreate()
    {
        $categories = ProductCategory::where('deleted_at',NULL)->pluck('name','id')->toArray();
        $locations = Location::where('deleted_at',NULL)->pluck('location_name','id')->toArray();
        $divisions = Division::where('deleted_at',NULL)->pluck('name','id')->toArray();
        $branches = Warehouse::where('deleted_at',NULL)->pluck('name','id')->toArray();
        $warranties = Warranty::pluck('warranty_name','id')->toArray();
        
        return view('apps.input.products',compact('categories','locations','divisions','branches','warranties'));
    }

    public function productStore(Request $request)
    {
        $this->validate($request, [
            'sap_code' => 'required|unique:products,sap_code',
            'name' => 'required|unique:products,name',
            'category_id' => 'required',
            'specification' => 'required',
            'image' => 'nullable|file|image',
            'branch_id' => 'required',
            'location_id' => 'required',
            'department_id' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $size = $file->getSize();
            $ext = $file->getClientOriginalExtension();
            $destinationPath = 'products';
            $extension = $file->getClientOriginalExtension();
            $filename=$file_name.'product.'.$extension;
            $uploadSuccess = $request->file('image')
            ->move($destinationPath, $filename);

            $input = [ 
                'sap_code' => $request->input('sap_code'),
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'price' => $request->input('price'),
                'purchase_date' => $request->input('purchase_date'),
                'image' => $filename,
                'warranty_period' => $request->input('warranty_period'),
                'specification' => $request->input('specification'),
                'branch_id' => $request->input('branch_id'),
                'location_id' => $request->input('location_id'),
                'department_id' => $request->input('department_id'),
                'created_by' => auth()->user()->id,
            ];
        } else {
            $input = [
                'sap_code' => $request->input('sap_code'),
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'price' => $request->input('price'),
                'purchase_date' => $request->input('purchase_date'),
                'warranty_period' => $request->input('warranty_period'),
                'specification' => $request->input('specification'),
                'branch_id' => $request->input('branch_id'),
                'location_id' => $request->input('location_id'),
                'department_id' => $request->input('department_id'),
                'created_by' => auth()->user()->id,
            ];
        }
        
        $data = Product::create($input);
        
        $log = 'Asset '.($data->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset '.($data->name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('asset.index')->with($notification);
    }

    public function downloadProduct()
    {
        return Excel::download( new ProductExport(), 'asset.csv',\Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]) ;
    }

    public function importTemplate()
    {
        $file = 'asset.xlsx';
        return response()->download(storage_path('/app/public/'. $file));
    }

    public function productImport()
    {
        return view('apps.input.assetImport');
    }

    public function productImportStore(Request $request)
    {
        $this->validate($request, [
            'asset' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);
        $data = new ProductImport();
        Excel::import($data, $request->file('asset'));

        $log = 'File Successfully Uploaded';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'File Successfully Uploaded',
            'alert-type' => 'success'
        );

        return redirect()->route('asset.index')->with($notification);
    }

    public function productShow($id)
    {
        $product = Product::find($id);
        $data = ProductMovement::where('product_id',$product->id)->get();
        
        return view('apps.show.products',compact('product','data'));
    }

    public function productEdit($id)
    {
        $data = Product::find($id);
        $categories = ProductCategory::where('deleted_at',NULL)->pluck('name','id')->toArray();
        $locations = Location::where('deleted_at',NULL)->pluck('location_name','id')->toArray();
        $divisions = Division::where('deleted_at',NULL)->pluck('name','id')->toArray();
        $branches = Warehouse::where('deleted_at',NULL)->pluck('name','id')->toArray();
        $warranties = Warranty::pluck('warranty_name','id')->toArray();
        
        return view('apps.edit.products',compact('data','categories','locations','divisions','branches','warranties'));
    }

    public function productUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'sap_code' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'specification' => 'required',
            'image' => 'nullable|file|image',
            'new_location_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $size = $file->getSize();
            $ext = $file->getClientOriginalExtension();
            $destinationPath = 'products';
            $extension = $file->getClientOriginalExtension();
            $filename=$file_name.'product.'.$extension;
            $uploadSuccess = $request->file('image')
            ->move($destinationPath, $filename);
            
            if ($request->filled('new_location_id')) {
                $input = [ 
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'image' => $filename,
                    'warranty_period' => $request->input('warranty_period'),
                    'specification' => $request->input('specification'),
                    'branch_id' => $request->input('new_branch_id'),
                    'location_id' => $request->input('new_location_id'),
                    'department_id' => $request->input('new_department_id'),
                    'updated_by' => auth()->user()->id,
                ];

                $movements = ProductMovement::create([
                    'product_id' => $id,
                    'origin_location' => $request->input('location_id'),
                    'origin_branch' => $request->input('branch_id'),
                    'destination_location' => $request->input('new_location_id'),
                    'destination_branch' => $request->input('new_branch_id'),
                ]);
            } else {
                $input = [ 
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'image' => $filename,
                    'warranty_period' => $request->input('warranty_period'),
                    'specification' => $request->input('specification'),
                    'updated_by' => auth()->user()->id,
                ];
            }
        } else {
            if ($request->filled('new_location_id')) {
                $input = [
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'warranty_period' => $request->input('warranty_period'),
                    'specification' => $request->input('specification'),
                    'branch_id' => $request->input('new_branch_id'),
                    'location_id' => $request->input('new_location_id'),
                    'department_id' => $request->input('new_department_id'),
                    'updated_by' => auth()->user()->id,
                ];

                $movements = ProductMovement::create([
                    'product_id' => $id,
                    'origin_location' => $request->input('location_id'),
                    'origin_branch' => $request->input('branch_id'),
                    'destination_location' => $request->input('new_location_id'),
                    'destination_branch' => $request->input('new_branch_id'),
                ]);
            } else {
                $input = [
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'warranty_period' => $request->input('warranty_period'),
                    'specification' => $request->input('specification'),
                    'updated_by' => auth()->user()->id,
                ];
            }
        }
        
        $data = Product::find($id);
        $data->update($input);
        $log = 'Asset '.($data->name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset '.($data->name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('asset.index')->with($notification);
    }

    public function productDestroy(Request $request)
    {
        $id = $request->post('id');
        $data = Product::find($id);
        $destroy = [
            'deleted_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => auth()->user()->id,
        ];
        $log = 'Asset '.($data->name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset '.($data->name).' Deleted',
            'alert-type' => 'success'
        );
        if($data->update($destroy)){
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully'; 
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response); 
    }

    public function productList()
    {
        $assets = Product::where('deleted_at',NULL)->get();

        return response()->json($assets);
    }

    public function movementIndex()
    {
        $data = Product::where('deleted_at'.NULL)->get();
        
        return view('apps.pages.productMovement',compact('data'));
    }

    public function movementCard(Request $request,$id)
    {
        $source = Product::where('id',$id)->first();
        
        $data = ProductMovement::where('product_id',$source->id)
                                   ->paginate(10);
        
        return view('apps.show.stockCard',compact('data'))->renderSections()['content'];
    }

    public function movementPrint(Request $request,$id)
    {
        $source = Product::where('id',$id)->first();
        $data = ProductMovement::where('product_id',$source->id)
                                ->get();
        $filename = Product::where('id',$source->id)->first();
        
        $pdf = PDF::loadview('apps.show.stockCardPrint',compact('data','source'));
        return $pdf->download('Movement Card '.$filename->name.'.pdf');
    }

    public function auditIndex()
    {
        $locations = Location::where('deleted_at',NULL)->pluck('location_name','location_name')->toArray();
        $branches = Warehouse::where('deleted_at',NULL)->pluck('name','name')->toArray(); 
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
                        ->where('tag_device_audits.location',$location)
                        ->where('tag_device_audits.created_at','>=',$request->input('start_date'))
                        ->where('tag_device_audits.created_at','<=',$request->input('end_date'))
                        ->select('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->groupBy('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->get();
            
            return view('apps.show.audit',compact('data'));
        } elseif ($location == null) {
            $data = Product::with('branches','locations')
                        ->join('tag_device_audits','tag_device_audits.sap_code','products.sap_code')
                        ->where('tag_device_audits.branch',$branch)
                        ->where('tag_device_audits.created_at','>=',$request->input('start_date'))
                        ->where('tag_device_audits.created_at','<=',$request->input('end_date'))
                        ->select('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->groupBy('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->get();
            
            return view('apps.show.audit',compact('data'));
        } else {
            $data = Product::with('branches','locations')
                        ->join('tag_device_audits','tag_device_audits.sap_code','products.sap_code')
                        ->where('tag_device_audits.branch',$branch)
                        ->where('tag_device_audits.location',$location)
                        ->where('tag_device_audits.created_at','>=',$request->input('start_date'))
                        ->where('tag_device_audits.created_at','<=',$request->input('end_date'))
                        ->select('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->groupBy('products.sap_code','products.name','products.branch_id','products.location_id','tag_device_audits.audit_branch','tag_device_audits.audit_location')
                        ->get();
            
            return view('apps.show.audit',compact('data'));
        }
    }
}
