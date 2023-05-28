<?php

namespace App\Http\Controllers\Inventory;


use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\sublocation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function ProductAll(){
        $product= Product::all();
        return view('manager.backend.product.product_all',compact('product'));
    } //end method 

    public function ProductAdd(){
        // get the data from the other tables
        $supplier=Supplier::all();
        $category=Category::all();
        $unit=Unit::all();
        $sub_location=sublocation::all();
        return view('manager.backend.product.product_add',compact('supplier','category','unit','sub_location'));
    }//end method 

    public function ProductStore(Request $request){
        $user = Auth::user();
        if ($user === null) {
        return view('/users/login')->with('message', 'You need to be logged in.');
        }
        else{
            $sublocationId = $request->sublocation_id !== '' ? $request->sublocation_id : null;
        Product::insert(
                    [
                        'name'=>$request->name,
                        'supplier_id'=>$request->supplier_id,
                        'unit_id'=>$request->unit_id,
                        'category_id'=>$request->category_id,
                        'quantity'=>'0',
                        'sublocation_id'=>$sublocationId,
                        'created_by'=>$user->id,
                        'created_at'=> Carbon::now(),
                    ]
                    );
        //Product_category charts 
// Update the quantity in the products_chart table
        // $this->updateProductsChart($request->category_id);


        $notification = array(
                        'message' => 'Product added Successfully', 
                        'alert-type' => 'success'
                    );
        return redirect()->route('product.all')->with($notification);
        }
}  //end method 

// Helper method to update the quantity in the products_details table
/*
private function updateProductsChart($category_id)
{
    // Count the number of products in the category
    $quantityPerCategory = Product::where('category_id', $category_id)->count();

    // Update or insert the record in the products_chart table
    DB::table('products_details')
        ->updateOrInsert(
            ['category_id' => $category_id],
            ['category_name' => Category::find($category_id)->name, 'quantity_per_category' => $quantityPerCategory]
        );
}
*/

public function ProductEdit($id)
{
    $user_id = Auth::user()->id; // Get the user ID of the logged-in user
    $supplier = Supplier::where('created_by', $user_id)->get();
    $category = Category::where('created_by', $user_id)->get(); // Select categories associated with the logged-in user
    $unit = Unit::where('created_by', $user_id)->get();
    $sub_location = Sublocation::where('created_by', $user_id)->get(); // Select sublocations associated with the logged-in user
    $product = Product::findOrFail($id);
    
    return view('manager.backend.product.product_edit', compact('product', 'supplier', 'category', 'unit', 'sub_location'));
}

        public function ProductUpdate(Request $request){
            $user = Auth::user();
            if ($user === null) {
            return view('/users/login')->with('message', 'You need to be logged in.');
            }
            else{
            $product_id =$request->id;
            Product::findOrFail($product_id)->update(
            [
                'name'=>$request->name,
                'status'=>$request->status,
                'supplier_id'=>$request->supplier_id,
                'unit_id'=>$request->unit_id,
                'category_id'=>$request->category_id,
                'sublocation_id'=>$request->sublocation_id,
                'updated_by'=>$user->id, 
                'updated_at'=> Carbon::now(),
            ]
            );
                //product_category
            // $this->updateProductsChart($request->category_id);


            $notification = array(
                'message' => 'Product updated Successfully', 
                'alert-type' => 'success'
            );
                    return redirect()->route('product.all')->with($notification);
        } 
}  //end method 
    public function ProductDelete($id){
        Product::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product deleted Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->back()->with($notification);
    } //end method
}
    

