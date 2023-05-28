<?php

namespace App\Http\Controllers\Inventory;


use App\Models\Unit;
use App\Models\Product;
use App\Models\sublocation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function UnitAll(){
        $units= Unit::all();
        $sublocation= sublocation::all();
        return view('manager.backend.unit.unit_all',compact('units','sublocation'));
    } //end method 

    public function UnitAdd(){
         return view('manager.backend.unit.unit_add');
    }

    public function UnitStore(Request $request){
    $user = Auth::user();
    if ($user === null) {
    return view('/users/login')->with('message', 'You need to be logged in.');
    }
    else{
    Unit::insert(
        [
            'name'=>$request->name,
            'created_by'=>$user->id,  //i think this one will be modified(it means in that column we will store the current user id on it) 
            'created_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'location added Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('unit.all')->with($notification);
    }
}  //end method 

    public function UnitEdit($id){
        $unit=Unit::findOrFail($id); //get the requested id 
        return view('manager.backend.unit.unit_edit',compact('unit'));
    } //end method 

    public function getSublocations($id)
    {
    $sublocations = Sublocation::where('location_id', $id)->get();

    return response()->json(['sublocations' => $sublocations]);
    }

    public function UnitUpdate(Request $request){
        $user = Auth::user();
    if ($user === null) {
    return view('/users/login')->with('message', 'You need to be logged in.');
    }
    else{
        $unit_id=$request->id; //get the  id
        Unit::findOrFail($unit_id)->update(
        [
            'name'=>$request->name,
            'updated_by'=>$user->id,  //i think this one will be modified(it means in that column we will store the current user id on it) 
            'updated_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'location updated Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('unit.all')->with($notification);
    }
    }//end method 

      public function UnitDelete($id){
        Unit::findOrFail($id)->delete();
    
    $notification = array(
            'message' => 'location deleted Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('unit.all')->with($notification);
    }
    public function displayProducts($id)
    {
        $unit=Unit::findOrFail($id);
        // Get the unit ID from the user.
    // Get the products from the database that are related to the unit ID.
    $products = Product::where('unit_id', $unit)->get();

    // Print the products.
    foreach ($products as $product) {
        echo $product->name . ' - ' .'<br>';
    }
        return view('manager.backend.unit.unit_display',compact('unit'));
    }
}
