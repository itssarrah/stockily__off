<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ChartController extends Controller
{


// public function user_chart()
// {
   
//     // Retrieve category_name and quantity_per_category from productdetails table
//     $productDetails = ProductDetails::select('category_name', DB::raw('SUM(quantity_per_category) as total_quantity'))
//         ->groupBy('category_name')
//         ->get();

    

//     $labels = [];
//     $data = [];

//     foreach ($productDetails as $product) {
//         array_push($labels, $product->category_name);
//         array_push($data, $product->total_quantity);
//     }

//     $datasets = [
//         [
//             'label' => 'Quantity per Category',
//             'data' => $data,
//         ],
//     ];

//     return view(route('manager.admin.index'))
//         ->with('datasets', $datasets)
//         ->with('labels', $labels);
// }


public function user_chart()
{
    $user_id = Auth::user()->id;

// Retrieve category name and count of products per category from the products table
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
        ->with('labels', $labels);
}


}
