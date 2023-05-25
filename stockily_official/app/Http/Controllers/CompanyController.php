<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

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
    $formFields = $request->validate([
        'company_name' => 'required|string|unique:companies',
        'company_logo' => 'nullable|image|mimes:jpeg,png|max:2048',
        'company_description' => 'required|nullable|string|min:10',
    ]);

    // Create a new Company instance
    $company = new Company();
    $company->company = $formFields['company_name'];
    // $company->image = $imageUrl;
    $company->desc = $formFields['company_description'];

    // Save the Company instance to the database
    if ($company->save()) {
        return redirect('/manager/add_role')->with('message', 'Company added successfully');
    } else {
        return redirect('/manager/continue_manager')->with('message', 'Company name already exists');
    }
}
    //to login 
    public function login() {
        return view('users.login');
    }
}

