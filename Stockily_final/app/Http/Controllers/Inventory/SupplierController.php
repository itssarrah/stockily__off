<?php

namespace App\Http\Controllers\Inventory;


use App\Models\ManagersEmployees;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function SupplierAll(){
        if (auth()->user()->role === 'manager'){
            $managerId = auth()->user()->id; // Get the current manager's ID
        }
        else{
            $managerId = ManagersEmployees::where('email', auth()->user()->email)
            ->value('managers_id');
        }
        $supplier = Supplier::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();
        
        return view('manager.backend.supplier.supplier_all',compact('supplier'));
        
    } //end method 

    public function SupplierAdd(){
        return view('manager.backend.supplier.supplier_add');
}
public function SupplierStore(Request $request){
    $user = Auth::user();
    if ($user === null) {
    return view('/users/login')->with('message', 'You need to be logged in.');
    }
    Supplier::insert(
        [
            'name'=>$request->name,
            'mobile_no'=>$request->mobile_no,
            'email'=>$request->email,
            'address'=>$request->address,
            'created_by'=>$user->id,  
            'created_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'Supplier added Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('supplier.all')->with($notification);
}  //end method 


    public function SupplierEdit($id){
        $supplier=Supplier::findOrFail($id); //get the requested id 
        return view('manager.backend.supplier.supplier_edit',compact('supplier'));
    } //end method 

    public function SupplierUpdate(Request $request){
        $user = Auth::user();
        if ($user === null) {
        return view('/users/login')->with('message', 'You need to be logged in.');
        }
        else{
        $supplier_id=$request->id; //get the  id
        Supplier::findOrFail($supplier_id)->update(
        [
            'name'=>$request->name,
            'mobile_no'=>$request->mobile_no,
            'email'=>$request->email,
            'address'=>$request->address,
            'created_by'=>$user->id,
            'updated_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'Supplier updated Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('supplier.all')->with($notification);
        }
    }//end method 
    public function SupplierDelete($id){
        Supplier::findOrFail($id)->delete();
    
    $notification = array(
            'message' => 'Supplier deleted Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('supplier.all')->with($notification);
    }
}
