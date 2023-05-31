<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Category;
use App\Models\ManagersEmployees;
use App\Models\Supplier;
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
    if (auth()->user()->role === 'manager'){
        $managerId = auth()->user()->id; // Get the current manager's ID
    }
    else{
        $managerId = ManagersEmployees::where('email', auth()->user()->email)
        ->value('managers_id'); 
    }
    
    $totalLocations = Unit::whereIn('created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
    })
    ->orWhere('created_by', $managerId) // Include the manager's ID as well
    ->count();

    $totalproducts = Product::whereIn('created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
    })
    ->orWhere('created_by', $managerId) // Include the manager's ID as well
    ->count();
    
    $totalsuppliers = Supplier::whereIn('created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
    })
    ->orWhere('created_by', $managerId) // Include the manager's ID as well
    ->count();

    $employees=DB::table('managers_employees')->where('managers_id','=',$managerId)->count();

    $productData = Product::join('categories', 'products.category_id', '=', 'categories.id')
    ->whereIn('products.created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId);
    })
    ->orWhere('products.created_by', $managerId)
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