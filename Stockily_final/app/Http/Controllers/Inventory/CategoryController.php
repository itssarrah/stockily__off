<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Category;
use App\Models\ManagersEmployees;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
     public function CategoryAll(){

        if (auth()->user()->role === 'manager'){
            $managerId = auth()->user()->id; // Get the current manager's ID
        }
        else{
            $managerId = ManagersEmployees::where('email', auth()->user()->email)
            ->value('managers_id');
        }
        $categories = Category::whereIn('created_by', function ($subquery) use ($managerId) {
            $subquery->select('users.id')
                ->from('users')
                ->join('managers_employees', 'managers_employees.email', '=', 'users.email')
                ->where('managers_employees.managers_id', $managerId); // Retrieve the invited users' IDs
        })
        ->orWhere('created_by', $managerId) // Include the manager's ID as well
        ->get();
        
        return view('manager.backend.category.category_all',compact('categories'));
    } //end method 

    
    public function CategoryAdd(){
         return view('manager.backend.category.category_add');
    }

    public function CategoryStore(Request $request){
        $user = Auth::user();
        if ($user === null) {
        return view('/users/login')->with('message', 'You need to be logged in.');
        }
    else{
    Category::insert(
        [
            'name'=>$request->name,
            'created_by'=>$user->id, 
            'created_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'Category added Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('category.all')->with($notification);
    }
}  //end method 

    public function CategoryEdit($id){
        $category=Category::findOrFail($id); //get the requested id 
        return view('manager.backend.category.category_edit',compact('category'));
    } //end method 

    public function CategoryUpdate(Request $request){
        $user = Auth::user();
        if ($user === null) {
        return view('/users/login')->with('message', 'You need to be logged in.');
        }
        $category_id=$request->id; //get the  id
        Category::findOrFail($category_id)->update(
        [
            'name'=>$request->name,
            'updated_by'=>$user->id,  //i think this one will be modified(it means in that column we will store the current user id on it) 
            'updated_at'=> Carbon::now(), //insert the current time 
        ]);
        $notification = array(
            'message' => 'Category updated Successfully', 
            'alert-type' => 'success'
        );
        
                return redirect()->route('category.all')->with($notification);
    }//end method 

      public function CategoryDelete($id){
        Category::findOrFail($id)->delete();
    
    $notification = array(
            'message' => 'Category deleted Successfully', 
            'alert-type' => 'success'
        );
                return redirect()->route('category.all')->with($notification);
    }
}
