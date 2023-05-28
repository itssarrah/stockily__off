<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagersEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managersEmployees = \App\Models\ManagersEmployees::all();

        return view('managers_employees.index', compact('managersEmployees'));
    }

}
