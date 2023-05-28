<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class CompanyController extends Controller
{
    // Show create company form
    public function create()
    {
        return view('manager.continue_manager');
    }

    // Store newly created company
    public function store(Request $request)
{
    $user = auth()->user(); 
    $formFields = $request->validate([
        'name_company' => 'required|string',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'company_description' => 'required|nullable',
        
    ]);

    $company = new Company();
    $company->name_company = $formFields['name_company'];
    $company->company_description = $formFields['company_description'];
    $company->created_by = $user->id;

    // Check if an image was uploaded
    if ($request->hasFile('company_logo')) {
        $image = $request->file('company_logo');
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('public/images', $filename);
        $path = str_replace('public/images/', '', $path);

        // Set the image path in the database
        $company->company_logo = $path;
    }

    $company->save();
    return redirect('/manager/admin/index')->with('message', 'Company added successfully');
}
    

    // to login
    public function login()
    {
        return view('users.login');
    }
}
