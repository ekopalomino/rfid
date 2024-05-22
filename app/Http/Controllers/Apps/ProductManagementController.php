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
use iteos\Exports\CategoryExport;
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
        $data = ProductCategory::orderBy('id','asc')->get();

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

    public function categoryDownload()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    public function getProductTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('Author','Categories','Branches','Locations','Divisions')->where('deleted_at',NULL);

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
                ->addColumn('divisions',function(Product $product){
                    return $product->divisions->name;
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
        $categories = ProductCategory::where('deleted_at',NULL)->get();
        $locations = Location::where('deleted_at',NULL)->where('sap_id','!=','1')->where('sap_id','!=','2')->where('sap_id','!=','3')->get();
        $branches = Warehouse::where('deleted_at',NULL)->get();
        $parents = Product::where('deleted_at',NULL)->get();
        $departments = Division::where('deleted_at'.NULL)->get();
        
        return view('apps.input.products',compact('categories','locations','branches','parents','departments'));
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
            'department_id' => 'required',
            'location_id' => 'required',
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
                'asset_id' => bin2hex($request->input('sap_code')), 
                'sap_code' => $request->input('sap_code'),
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'parent_id' => $request->input('parent_id'),
                'price' => $request->input('price'),
                'purchase_date' => $request->input('purchase_date'),
                'image' => $filename,
                'specification' => $request->input('specification'),
                'branch_id' => $request->input('branch_id'),
                'location_id' => $request->input('location_id'),
                'department_id' => $request->input('dept_id'),
                'created_by' => auth()->user()->id,
            ];
        } else {
            $input = [
                'asset_id' => bin2hex($request->input('sap_code')),
                'sap_code' => $request->input('sap_code'),
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'parent_id' => $request->input('parent_id'),
                'price' => $request->input('price'),
                'purchase_date' => $request->input('purchase_date'),
                'specification' => $request->input('specification'),
                'branch_id' => $request->input('branch_id'),
                'location_id' => $request->input('location_id'),
                'department_id' => $request->input('dept_id'),
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
        return Excel::download( new ProductExport(), 'asset.xls') ;
    }

    public function importTemplate()
    {
        $file = 'assets.xlsx';
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
        $rows = $data->getRowCount();
        $log = ''.($rows).' Successfully Uploaded';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => ''.($rows).' Successfully Uploaded',
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
        $categories = ProductCategory::where('deleted_at',NULL)->get();
        $locations = Location::where('deleted_at',NULL)->get();
        $departments = Division::where('deleted_at',NULL)->get();
        $branches = Warehouse::where('deleted_at',NULL)->get();
        $parents = Product::where('deleted_at',NULL)->get();
        
        return view('apps.edit.products',compact('data','categories','locations','branches','departments','parents'));
    }

    public function productUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'sap_code' => 'required',
            'name' => 'required',
            'image' => 'nullable|file|image',
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
            
            if ($request->input('location_id') != $request->input('old_location_id')) {
                $input = [
                    'asset_id' => bin2hex($request->input('sap_code')), 
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'parent_id' => $request->input('parent_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'specification' => $request->input('specification'),
                    'branch_id' => $request->input('branch_id'),
                    'location_id' => $request->input('location_id'),
                    'updated_by' => auth()->user()->id,
                ];

                $movements = ProductMovement::create([
                    'product_id' => $id,
                    'origin_location' => $request->input('location_id'),
                    'origin_branch' => $request->input('branch_id'),
                    'origin_department' => $request->input('department_id'),
                ]);
            } elseif ($request->input('branch_id') != $request->input('old_branch_id')) {
                $input = [
                    'asset_id' => bin2hex($request->input('sap_code')),
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'specification' => $request->input('specification'),
                    'branch_id' => $request->input('branch_id'),
                    'location_id' => $request->input('location_id'),
                    'updated_by' => auth()->user()->id,
                ];

                $movements = ProductMovement::create([
                    'product_id' => $id,
                    'origin_location' => $request->input('location_id'),
                    'origin_branch' => $request->input('branch_id'),
                    'origin_department' => $request->input('department_id'),
                ]);
            } else {
                $input = [
                    'asset_id' => bin2hex($request->input('sap_code')),
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'specification' => $request->input('specification'),
                    'updated_by' => auth()->user()->id,
                ];
            }
        } else {
            if ($request->input('branch_id') != $request->input('old_branch_id')) {
                $input = [
                    'asset_id' => bin2hex($request->input('sap_code')),
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'specification' => $request->input('specification'),
                    'branch_id' => $request->input('branch_id'),
                    'location_id' => $request->input('location_id'),
                    'updated_by' => auth()->user()->id,
                ];

                $movements = ProductMovement::create([
                    'product_id' => $id,
                    'origin_location' => $request->input('location_id'),
                    'origin_branch' => $request->input('branch_id'),
                    'origin_department' => $request->input('department_id'),
                ]);
            } elseif ($request->input('location_id') != $request->input('old_location_id')) {
                $input = [
                    'asset_id' => bin2hex($request->input('sap_code')), 
                    'sap_code' => $request->input('sap_code'),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'parent_id' => $request->input('parent_id'),
                    'price' => $request->input('price'),
                    'purchase_date' => $request->input('purchase_date'),
                    'specification' => $request->input('specification'),
                    'branch_id' => $request->input('branch_id'),
                    'location_id' => $request->input('location_id'),
                    'updated_by' => auth()->user()->id,
                ];

                $movements = ProductMovement::create([
                    'product_id' => $id,
                    'origin_location' => $request->input('location_id'),
                    'origin_branch' => $request->input('branch_id'),
                    'origin_department' => $request->input('department_id'),
                ]); 
            } else {
                $input = [
                    'asset_id' => bin2hex($request->input('sap_code')),
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

    public function movementIndex(Request $request)
    {
        if($request->ajax()) {
            $data = Product::with('Branches','Locations')->where('deleted_at'.NULL)->orderBy('id','ASC');

            return DataTables::eloquent($data)
            ->addIndexColumn()
                ->addColumn('branches',function(Product $product){
                    return $product->branches->name;
                })
                ->addColumn('locations',function(Product $product){
                    return $product->locations->location_name;
                })
                ->addColumn('updated_at',function($row){
                    $date = date("d F Y H:i", strtotime($row->updated_at));
                    return $date;
                })
                ->addColumn('action', function($row){
                    // Update Button
                    $viewButton = "<a class='btn btn-xs btn-info modalLg' href='#' value='".route('movement.card',$row->id)."' data-toggle='modal' data-target='#modalLg'><i class='fa fa-search'></i></a>";
                    
                    return $viewButton;

                }) 
                ->make();
        }
        return view('apps.pages.productMovement');
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
}
