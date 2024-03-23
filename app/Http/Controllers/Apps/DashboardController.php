<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Product;
use iteos\Models\ProductMovement;
use iteos\Models\Warehouse;
use iteos\Models\ProductCategory;
use iteos\Charts\DashboardChart;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAsset = Product::where('deleted_at',NULL)->count();
        $totalBundle = DB::table('products')->where('deleted_at',NULL)->count(DB::raw('DISTINCT parent_id'));
        $totalDeleteAsset = Product::whereNotNull('deleted_at')->count();

        $branches = DB::table('products')
                        ->join('warehouses','warehouses.id','products.branch_id')
                        ->where('products.deleted_at',NULL)
                        ->select(DB::raw('warehouses.name as Branch'),DB::raw('count(products.id) as Count'))
                        ->groupBy('warehouses.name')
                        ->get();
        $branch[] = ['Branch','Count'];
        foreach($branches as $key=>$value) {
            $branch[++$key] = [$value->Branch,(int)$value->Count];
        }

        $categories = DB::table('products')
                        ->join('product_categories','product_categories.id','products.category_id')
                        ->where('products.deleted_at',NULL)
                        ->select(DB::raw('product_categories.name as Category'),DB::raw('count(products.id) as Count'))
                        ->groupBy('product_categories.name')
                        ->get();
        $category[] = ['Category','Count'];
        foreach($categories as $key=>$value) {
            $category[++$key] = [$value->Category,(int)$value->Count];
        }
        
        return view('apps.pages.dashboard',compact('totalAsset','totalBundle','totalDeleteAsset'))->with('branches',json_encode($branch))->with('categories',json_encode($category));
    }
}
