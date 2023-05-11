<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //show registers/create the form 
public function create(){
    return view('users.register');
}

//create  a new user 

public function store(Request $request){
    $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8',
            'role' => 'required|string',
        ]);
    // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
    // Create User
        $user = User::create($formFields);
    //test
    if ($request->input('role') == 'manager') {
        return redirect('/manager/continue_manager');
    } else {
        return redirect('/users/login');
    }
    //login
    auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
}
  // Logout User
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }
     // Show Login Form
    public function login() {
        return view('users.login');
    }

        public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
//if the loggin is valid 
        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            // Redirect based on role
            $user = auth()->user();
            if ($user->role == 'manager') {
                $var=true;
                return redirect('/manager/admin/index')->with('message', 'You are now logged in as a manager!');
            } else {
                return redirect('/users/dashboard')->with('message', 'You are now logged in as a user!');
            }
        }
//if the loggin fails (whether the email or password are invalid)
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
    //add from the basic from the basic project 
    public function Profile()
        {
            if (auth()->check()) {
                $currentUserId = auth()->user()->id;
                $adminData = DB::table('users')->where('id', $currentUserId)->first();
                return view('manager.admin.admin_profile_view', compact('adminData'));
            } else {
                return redirect('/users/login')->with('message', 'Please log in to access your profile.');
            }
        }

public function EditProfile()
        {
            if (auth()->check()) {
                $currentUserId = auth()->user()->id;
                $editData = DB::table('users')->where('id', $currentUserId)->first();
                return view('manager.admin.admin_profile_edit', compact('editData'));
            } else {
                return redirect('/users/login')->with('message', 'Please log in to edit your profile.');
            }
        }
    
//the edit 
public function StoreProfile(Request $request){
    $id = auth()->user()->id;
    $data = User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;

    if ($request->file('profile_image')) {
       $file = $request->file('profile_image');

       $filename = date('YmdHi').$file->getClientOriginalName();
       $file->move(public_path('upload/admin_images'),$filename);
       $data['profile_image'] = $filename;
    }
    $data->save();

    $notification = array(
        'message' => 'Admin Profile Updated Successfully', 
        'alert-type' => 'info'
    );

    return redirect()->route('admin.profile')->with($notification);

}// End Method

//loggout manager
public function destroy(Request $request)
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    $notification = array(
        'message' => 'User Logout Successfully', 
        'alert-type' => 'success'
    );

    return redirect('/')->with($notification);
} // End Method 

}