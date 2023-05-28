<?php

namespace App\Http\Controllers\Inventory;


use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function SupplierAll(){
        $supplier= supplier::all();
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