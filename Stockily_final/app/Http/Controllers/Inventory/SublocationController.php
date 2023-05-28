<?php

namespace App\Http\Controllers\Inventory;
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
        $sublocation= sublocation::all();
        $units=Unit::all();
        return view('manager.backend.unit.unit_all',compact('units','sublocation'));
    } //end method 

    public function sublocation_add(){
        $unit=Unit::all();
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
