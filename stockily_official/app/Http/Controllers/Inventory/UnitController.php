<?php

namespace App\Http\Controllers\Inventory;


use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function UnitAll(){
        $units= Unit::all();
        return view('manager.backend.unit.unit_all',compact('units'));
    } //end method 

    public function UnitAdd(){
         return view('manager.backend.unit.unit_add');
    }

    public function UnitStore(Request $request){
    Unit::insert(
        [
            'name'=>$request->name,
            'created_by'=>request()->user()->id,  //i think this one will be modified(it means in that column we will store the current user id on it) 
            'created_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'Unit added Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('unit.all')->with($notification);
        }  //end method 

    public function UnitEdit($id){
        $unit=Unit::findOrFail($id); //get the requested id 
        return view('manager.backend.unit.unit_edit',compact('unit'));
    } //end method 

    public function UnitUpdate(Request $request){
        $unit_id=$request->id; //get the  id
        Unit::findOrFail($unit_id)->update(
        [
            'name'=>$request->name,
            'updated_by'=>request()->user()->id,  //i think this one will be modified(it means in that column we will store the current user id on it) 
            'updated_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'Unit updated Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('unit.all')->with($notification);
    }//end method 

      public function UnitDelete($id){
        Unit::findOrFail($id)->delete();
    
    $notification = array(
            'message' => 'Unit deleted Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('unit.all')->with($notification);
    }
}
