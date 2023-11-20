<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Product;
use iteos\Models\ProductCategory;
use iteos\Models\Location;
use iteos\Models\Division;
use iteos\Models\ProductBom;
use iteos\Models\UomValue;
use iteos\Models\Warehouse;
use iteos\Models\Contact;
use iteos\Models\Inventory;
use iteos\Models\InventoryMovement;
use iteos\Models\ProductMovement;
use iteos\Models\Warranty;
use Auth;
use PDF;
use File;
use Carbon\Carbon;

class ProductManagementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Can Access Products');
        $this->middleware('permission:Can Create Product', ['only' => ['create','store']]);
        $this->middleware('permission:Can Edit Product', ['only' => ['edit','update']]);
        $this->middleware('permission:Can Delete Product', ['only' => ['destroy']]);
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

    public function productIndex()
    {
    	$data = Product::orderBy('name','asc')->get();

    	return view('apps.pages.products',compact('data'));
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
            'rfid_code' => 'required|unique:products,rfid_code',
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
                'rfid_code' => $request->input('rfid_code'),
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
                'rfid_code' => $request->input('rfid_code'),
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
        
        $log = 'Asset '.($data->name).' Successfully Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Asset '.($data->name).' Successfully Created',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);
    }

    public function productShow($id)
    {
        $product = Product::find($id);
        $boms = ProductBom::where('product_id',$id)->get();

        return view('apps.show.products',compact('product','boms'));
    }

    public function productPdf($id)
    {
        $product = Product::find($id);
        $boms = ProductBom::where('product_id',$id)->get();

        $pdf = PDF::loadview('apps.show.products',compact('product','boms'));
        return $pdf->download('product-detail.pdf');
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
            'rfid_code' => 'required',
            'sap_code' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'specification' => 'required',
            'image' => 'nullable|file|image',
            'new_location_id' => 'unique:products,location_id'
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
                'rfid_code' => $request->input('rfid_code'),
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
                'rfid_code' => $request->input('rfid_code'),
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
        
        $data = Product::find($id);
        $data->update($input);
        $log = 'Produk '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Produk '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);
    }

    public function productDestroy($id)
    {
        $data = Product::find($id);
        $destroy = [
            'deleted_at' => Carbon::now()->toDateTimeString(),
            'updated_by' => auth()->user()->id,
        ];
        $log = 'Produk '.($data->name).' Berhasil Dinonaktifkan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Produk '.($data->name).' Berhasil Dinonaktifkan',
            'alert-type' => 'success'
        );
        $data->update($destroy);
        
        return redirect()->route('product.index')->with($notification);
    }

    public function movementIndex()
    {
        $data = ProductMovement::get();
        
        return view('apps.pages.productMovement',compact('data'));
    }



    public function indexBom()
    {
        $data = Product::get();
        
        return view('apps.pages.productBom',compact('data'));
    }

    public function createBom(Request $request,$id)
    {
        $materials = Product::pluck('name','name')->toArray();
        $uoms = UomValue::pluck('name','id')->toArray();
        $boms = ProductBom::where('product_id',$id)->get();
        $id = Product::where('id',$id)->first();
        
        return view('apps.input.productBom',compact('materials','uoms','boms','id'));
    }

    public function storeBom(Request $request)
    {
        $this->validate($request, [
            'material_name' => 'required',
            'quantity' => 'required|numeric',
            'uom_id' => 'required',
        ]);

        $input = $request->all();
        
        $data = ProductBom::create($input);
        $log = 'Bill of Material'.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Bill of Material'.($data->name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editBom($id)
    {
        $data = ProductBom::find($id);
        $materials = Product::pluck('name','id')->toArray();
        $uoms = UomValue::pluck('name','id')->toArray();

        return view('apps.edit.productBom',compact('data','materials','uoms'))->renderSections()['content'];
    }

    public function updateBom(Request $request,$id)
    {
        $input = $request->all();

        $data = ProductBom::find($id)->update($input);
        $log = 'Bill of Material Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Bill of Material Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function destroyBom($id)
    {
        $data = ProductBom::find($id);
        $log = 'Bill of Material Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Bill of Material Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->back()->with($notification);
    }
}
