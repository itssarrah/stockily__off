<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


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
                return redirect('/manager/manager_dashboard')->with('message', 'You are now logged in as a manager!');
            } else {
                return redirect('/users/dashboard')->with('message', 'You are now logged in as a user!');
            }
        }
//if the loggin fails (whether the email or password are invalid)
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}