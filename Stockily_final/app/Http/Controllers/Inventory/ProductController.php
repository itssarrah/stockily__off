<?php

namespace App\Http\Controllers\Inventory;


use App\Models\ManagersEmployees;
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
        if (auth()->user()->role === 'manager'){
            $managerId = auth()->user()->id; // Get the current manager's ID
        }
        else{
            $managerId = ManagersEmployees::where('email', auth()->user()->email)
            ->value('managers_id'); 
        }
        
        $product = Product::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();

        return view('manager.backend.product.product_all',compact('product'));
    } //end method 

    public function ProductAdd(){
        // get the data from the other tables
        if (auth()->user()->role === 'manager'){
            $managerId = auth()->user()->id; // Get the current manager's ID
        }
        else{
            $managerId = ManagersEmployees::where('email', auth()->user()->email)
            ->value('managers_id'); 
        }
        
        $unit = Unit::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();

        $sub_location = sublocation::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();

        $category = Category::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();
        
        $supplier = Supplier::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();
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


public function ProductEdit($id)
{
    
    if (auth()->user()->role === 'manager'){
        $managerId = auth()->user()->id; // Get the current manager's ID
    }
    else{
        $managerId = ManagersEmployees::where('email', auth()->user()->email)
        ->value('managers_id'); 
    }
    
    $unit = Unit::whereIn('created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
    })
    ->orWhere('created_by', $managerId) // Include the manager's ID as well
    ->get();

    $sub_location = sublocation::whereIn('created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
    })
    ->orWhere('created_by', $managerId) // Include the manager's ID as well
    ->get();

    $category = Category::whereIn('created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
    })
    ->orWhere('created_by', $managerId) // Include the manager's ID as well
    ->get();
    
    $supplier = Supplier::whereIn('created_by', function ($subquery) use ($managerId) {
        $subquery->select('users.id')
            ->from('users')
            ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
            ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
    })
    ->orWhere('created_by', $managerId) // Include the manager's ID as well
    ->get();

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
                'supplier_id'=>$request->supplier_id,
                'unit_id'=>$request->unit_id,
                'category_id'=>$request->category_id,
                'sublocation_id'=>$request->sublocation_id === "" ? null : $request->sublocation_id,
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
    

