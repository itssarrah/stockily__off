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

class SublocationController extends Controller
{

    public function subUpdate(Request $request){
        $user = Auth::user();
        if ($user === null) {
            return view('/users/login')->with('message', 'You need to be logged in.');
        }
        else{
            $unit_id=$request->id; //get the  id
            sublocation::findOrFail($unit_id)->update(
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
    public function subEdit($id){
        $unit=sublocation::findOrFail($id); //get the requested id 
        return view('manager.backend.unit.sublocation_edit',compact('unit'));
    } //end method

    public function sublocationDelete($id)
    {
        $sublocation = sublocation::find($id);
    if ($sublocation) {
        $sublocation->delete();

        $notification = array(
            'message' => 'Location deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
    }

    // Handle the case when the sublocation doesn't exist
    $notification = array(
        'message' => 'Location not found',
        'alert-type' => 'error'
    );

    return redirect()->route('unit.all')->with($notification);
    }
    public function sublocation_all(){
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

    public function sublocation_add(){
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

        return view('manager.backend.unit.sublocation_add',compact('unit'));
    }

    public function sublocation_store(Request $request){
    $user = Auth::user();
    if ($user === null) {
    return view('/users/login')->with('message', 'You need to be logged in.');
    }
    else{
        sublocation::insert(
            [
                'name'=>$request->name,
                'location_id'=>$request->unit_id,
                'created_by'=>$user->id,
                'created_at'=> Carbon::now(),
            ]
            );
        $notification = array(
                'message' => 'sublocation added Successfully', 
                'alert-type' => 'success'
            );
                return redirect()->route('unit.all')->with($notification);
    }
}  //end method 

    
}
