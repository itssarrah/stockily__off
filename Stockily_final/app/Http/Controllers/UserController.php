<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\ManagersEmployees;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //show registers/create the form 
public function create(){
    return view('users.register');
}

public function createNormal(Request $request)
{
    $urlToken = $request->query('token');

    // Find the record in the managers_employees table based on the token
    $managerEmployee = ManagersEmployees::where('token', $urlToken)->first();

    if (!$managerEmployee) {
        $notification = array(
            'message' => 'Category added Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('home')->with('error', 'Invalid token. Please try again.');
    }

    $tokenExpiry = Carbon::parse($managerEmployee->token_expiry);

    // Check if the token has expired
    if ($tokenExpiry->isPast()) {
        return redirect()->route('home')->with('error', 'Token has expired. Please request a new invitation to your manager.');
    }

    // If the token is valid and not expired, pass the necessary data to the view
    return view('users.register_normal', ['token' => $urlToken]);
}


//create  a new user 
public function changePassword() {
        
    return view('manager.admin.admin_change_password');
}

public function updatePassword(Request $request) {

    $request->validate([
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'confirm_password' => 'required|same:newpassword'
    ]);

    $hashPassword = Auth::user()->password;
    if(Hash::check($request->oldpassword, $hashPassword)){
        $user = User::find(Auth::id());
        $user->password = bcrypt($request->newpassword);
        $user->save();

        session()->flash('message', 'password Updated Successfully');

        return redirect()->back();
    } else {
        session()->flash('message', 'Old Password not right');

        return redirect()->back();
    }
}

    /*public function store(Request $request){
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
    }*/

    public function store(Request $request)
{
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

    // Log in the user
    auth()->login($user);

    // Redirect the user based on their role
    if ($request->input('role') == 'manager') {
        return redirect('/manager/continue_manager');
    } else {
        return redirect('/users/dashboard');
    }
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
                if (auth()->user()->role === 'manager'){
                    $currentUserId = auth()->user()->id;
                    $adminData = DB::table('users')->where('id', $currentUserId)->first();
                    $company = DB::table('companies')->where('created_by' , $currentUserId)->first();
                    $employeeIds = DB::table('managers_employees')
                    ->join('users', 'managers_employees.email', '=', 'users.email')
                    ->where('managers_employees.managers_id', $currentUserId)
                    ->pluck('users.id');

                    $employeeImages = DB::table('images')->whereIn('created_by', $employeeIds)->get();
                    $employeeData = DB::table('users')->whereIn('id', $employeeIds)->get();
                    return view('manager.admin.admin_profile_view', compact('adminData','company','employeeImages' , 'employeeData' ));
                }
                else{

                    $currentUserId = auth()->user()->id;
                    $managerId = DB::table('managers_employees')
                    ->where('email', auth()->user()->email)
                    ->value('managers_id');

                    $adminData = DB::table('users')->where('id', $currentUserId)->first();
                    $image = DB::table('images')->where('created_by' , $currentUserId)->first();
                    $company =DB::table('companies')->where('created_by' , $managerId)->first();

                    
                    return view('manager.admin.admin_profile_view', compact('adminData','image','company' ));
                }
            } else {
                return redirect('/users/login')->with('message', 'Please log in to access your profile.');
            }
        }

public function EditProfile()
        {
            if (auth()->check()) {
                $currentUserId = auth()->user()->id;
                $editData = DB::table('users')->where('id', $currentUserId)->first();
                $company = DB::table('companies')->where('created_by' , $currentUserId)->first();
                $image = DB::table('images')->where('created_by' , $currentUserId)->first();
                return view('manager.admin.admin_profile_edit', compact('editData' , 'company' , 'image'));
            } else {
                return redirect('/users/login')->with('message', 'Please log in to edit your profile.');
            }
        }

public function StoreProfile(Request $request)
{
    $user = auth()->user();
    if ($user->role === 'manager')
    {
        $id = auth()->user()->id;
        $data = User::find($id);
        $company = Company::where('created_by', $id)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $company->company_description = $request->company_description;
        $company->name_company = $request->name_company;
    
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $filename);
            $path = str_replace('public/images/', '', $path);
    
            // Set the image path in the database
            $company->company_logo = $path;
        }
    
        $data->save();
        $company->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'info'
        );
    
        return redirect()->route('admin.profile')->with($notification);
    }
    $id = auth()->user()->id;
    $data = User::find($id);
    $data->name = $request->name;
    $data->email = $request->email;

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/images', $filename);
        $path = str_replace('public/images/', '', $path);
        $currimage = Image::where('created_by', $id)->first();

        if ($currimage) {
            // Update the existing image record
            $currimage->profile_image = $path;
            $currimage->save();
        } else {
            // Create a new image record for the user
            $image = new Image();
            $image->profile_image = $path;
            $image->created_by = $id;
            $image->save();
        }
    }

    $data->save();
    $notification = array(
        'message' => 'Admin Profile Updated Successfully',
        'alert-type' => 'info'
    );

    return redirect()->route('admin.profile')->with($notification);
   
}


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