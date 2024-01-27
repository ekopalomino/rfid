<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Product;
use iteos\Models\ProductMovement;
use iteos\Charts\DashboardChart;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAsset = Product::where('deleted_at',NULL)->count();
        $totalDeleteAsset = Product::whereNotNull('deleted_at')->count();
        $newAsset = Product::whereDate('created_at', Carbon::now()->subDays(7))->count();
        
        return view('apps.pages.dashboard',compact('totalAsset','totalDeleteAsset','newAsset'));
    }
}
