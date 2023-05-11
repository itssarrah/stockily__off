<?php

namespace App\Http\Controllers\Inventory;


use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        return view('manager.backend.product.product_add',compact('supplier','category','unit'));
    }//end method 

    public function ProductStore(Request $request){
        Product::insert(
            [
                'name'=>$request->name,
                'supplier_id'=>$request->supplier_id,
                'unit_id'=>$request->unit_id,
                'category_id'=>$request->category_id,
                'quantity'=>'0',
                'created_by'=>Auth::user()->id,
                'created_at'=> Carbon::now(),
            ]
            );
    
     $notification = array(
            'message' => 'Product added Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('product.all')->with($notification);
        }  //end method 


        public function ProductEdit($id){
        $supplier=Supplier::all();
        $category=Category::all();
        $unit=Unit::all();
        $product=Product::findOrFail($id);
        return view('manager.backend.product.product_edit',compact('product','supplier','category','unit'));
        } //end method 

        public function ProductUpdate(Request $request){
            $product_id =$request->id;
            Product::findOrFail($product_id)->update(
            [
                'name'=>$request->name,
                'supplier_id'=>$request->supplier_id,
                'unit_id'=>$request->unit_id,
                'category_id'=>$request->category_id,
                'updated_by'=>Auth::user()->id, //should be modified
                'updated_at'=> Carbon::now(),
            ]
            );
    
     $notification = array(
            'message' => 'Product updated Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('product.all')->with($notification);

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
    


