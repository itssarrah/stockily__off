<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\ManagersEmployees;
use App\Models\User;

class ManagersEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently logged manager's ID
        $managerId = Auth::id();

        // Retrieve the employees' email and user ID associated with the manager
        $employees = ManagersEmployees::where('managers_id', $managerId)
            ->join('users', 'managers_employees.email', '=', 'users.email')
            ->select('managers_employees.email', 'users.id')
            ->get();

        return view('manager.admin.admin_profile_view', compact('employees'));
    }
}
