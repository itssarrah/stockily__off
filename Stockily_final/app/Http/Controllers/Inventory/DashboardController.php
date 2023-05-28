<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Unit; 
use App\Models\Product; 
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

public function dashboard_details()
{

    $user_id = Auth::user()->id; 
    $totalLocations = DB::table('units')->where('created_by', '=', $user_id)
    ->count();
    $totalproducts = DB::table('products')->where('created_by', '=', $user_id)
    ->count();
    $totalsuppliers = DB::table('suppliers')->where('created_by', '=', $user_id)
    ->count();
    $employees=DB::table('managers_employees')->where('managers_id','=',$user_id)->count();

    // Retrieve category_name and quantity_per_category from productdetails table
    // $productDetails = ProductDetails::select('category_name', DB::raw('SUM(quantity_per_category) as total_quantity'))
    //     ->groupBy('category_name')
    //     ->get();

    // $labels = [];
    // $data = [];

    // foreach ($productDetails as $product) {
    //     array_push($labels, $product->category_name);
    //     array_push($data, $product->total_quantity);
    // }

    // $datasets = [
    //     [
    //         'label' => 'Quantity per Category',
    //         'data' => $data,
    //     ],
    // ];

    $productData = DB::table('products')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->where('products.created_by', $user_id)
    ->select('categories.name as category_name', DB::raw('COUNT(products.id) as total_quantity'))
    ->groupBy('categories.name')
    ->get();

    $labels = [];
    $data = [];

    foreach ($productData as $product) {
        array_push($labels, $product->category_name);
        array_push($data, $product->total_quantity);
    }

    $datasets = [
        [
            'label' => 'Quantity per Category',
            'data' => $data,
        ],
    ];

    return view('manager.admin.index')
        ->with('datasets', $datasets)
        ->with('labels', $labels)
        ->with('totalLocations',$totalLocations)
        ->with('totalproducts',$totalproducts)
        ->with('totalsuppliers',$totalsuppliers)
        ->with('totalemployees',$employees);
}
}