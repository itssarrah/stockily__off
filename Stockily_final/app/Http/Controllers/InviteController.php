<?php

namespace App\Http\Controllers;

use App\Mail\InviteEmployee;
use App\Models\ManagersEmployees;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InviteController extends Controller
{
    /**
     * Summary of SendEmail
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    

    public function SendEmail(Request $request)
    {
        $email = $request->input('empeml');
        $check = DB::table('managers_employees')->where('email', $email)->first();
        if ($check){
            return redirect()->route('company')->with('error', 'This email is already taken by a manager');
        }

        $user = DB::table('users')->where('email', $email)->first();
    
        if (!$user) {
            $manager = Auth::user();
            $token = Str::random(32); // Generate a unique token for the invitation link
            $tokenExpiry = Carbon::now()->addHours(24);
            // Save the token and manager's ID in the managers_employees table
            ManagersEmployees::create([
                'managers_id' => $manager->id,
                'token' => $token,
                'email' => $email,
                'token_expiry' => $tokenExpiry,
            ]);
    
            $invitationLink = url('/users/register_normal?token=' . $token);
    
            Mail::to($email)->send(new InviteEmployee($invitationLink));
        } 
        else {
            if ($user->role === 'normal user') {
            return redirect()->route('company')->with('error', 'This email joined a manager');
            }
            else {
                return redirect()->route('company')->with('error', 'This email belongs to a manager');
            }
        }

        return redirect('/manager/add_role')->with('success', 'Email Sent !');
    }

   
}
