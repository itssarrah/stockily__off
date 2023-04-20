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
            'company_name' => 'required|string',
            'company_logo' => 'required|image|mimes:jpeg,png|max:2048',
            'company_description' => 'required|nullable|string|min:10',
        ]);
        //the image 
        $image = $request->file('company_logo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        // Create Company
        $imagePath = $request->file('company_logo')->store('public/images');
        $imageUrl = asset('storage/' . $imagePath);

        // Create a new Company instance
        $company = new Company();
        $company->company = $formFields['company_name'];
        $company->image = $imageUrl;
        $company->desc = $formFields['company_description'];

        // Save the Company instance to the database
        $company->save();
        

        return redirect('/')->with('message', 'Company added successfully');
    }
    //to login 
    public function login() {
        return view('users.login');
    }
}

