<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function getCategory(Request $request) {

        $supplier_id = $request->supplier_id;
        
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        //dd($allCategory);
        return response()->json($allCategory);
    }

    public function getProduct(Request $request) {

        $category_id = $request->category_id;
        
        $allProduct = Product::where('category_id', $category_id)->get();
        //dd($allCategory);
        return response()->json($allProduct);
    }

    public function getStock(Request $request){

        $product_id = $request->product_id;
        $stock = Product::where('id', $product_id)->first()->quantity;
        return response()->json($stock);
    }
}
