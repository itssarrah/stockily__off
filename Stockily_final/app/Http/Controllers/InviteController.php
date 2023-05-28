<?php

namespace App\Http\Controllers;

use App\Mail\InviteEmployee;
use App\Models\ManagersEmployees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    /**
     * Summary of SendEmail
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function SendEmail(Request $request)
    {
        $result = DB::table('users')->select('id')->where('email', $request->empeml)->get();
if ($result->count() === 0) {
    echo 'This email is not registered';
} else {
    $ss = $result->first()->id;
    $resultt = DB::table('managers_employees')->select('id')->where('id', $ss)->get();
    if ($resultt->count() !== 0) {
        echo 'This email is already taken by a manager';
    } else {
        $user = Auth::user();
        ManagersEmployees::insert([
            'employees_id' => $ss,
            'managers_id' => $user->id,
        ]);
    }
}

        $data = [
            'subject'=>'Your Invitation Link'
        ];
        Mail::to($request->input('empeml'))->send(new InviteEmployee($data)); 
        return redirect('/manager/add_role'); 

    }

   
}
