<?php

namespace App\Http\Controllers\Inventory;


use App\Models\ManagersEmployees;
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
        if (auth()->user()->role === 'manager'){
            $managerId = auth()->user()->id; // Get the current manager's ID
        }
        else{
            $managerId = ManagersEmployees::where('email', auth()->user()->email)
            ->value('managers_id'); 
        }
        
        $units = Unit::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();

        $sublocation = sublocation::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();
        
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
