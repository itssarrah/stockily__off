<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetails;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ProductsDetailsController extends Controller
{
     public function update()
    {
        // Clear existing records in the products_chart table
        DB::table('products_details')->truncate();

        // Retrieve all categories
        $categories = Category::all();

        foreach ($categories as $category) {
            // Count the number of products in the category
            $quantityPerCategory = Product::where('category_id', $category->id)->count();

            // Insert a new record in the products_chart table
            DB::table('products_details')->insert([
                'category_id' => $category->id,
                'category_name' => $category->name,
                'quantity_per_category' => $quantityPerCategory,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Products chart has been updated.']);
    }//end method 
}
