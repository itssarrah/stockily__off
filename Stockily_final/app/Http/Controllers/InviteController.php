<?php

namespace App\Http\Controllers;

use App\Mail\InviteEmployee;
use App\Models\ManagersEmployees;
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
            
            // Save the token and manager's ID in the managers_employees table
            ManagersEmployees::create([
                'managers_id' => $manager->id,
                'token' => $token,
                'email' => $email,
            ]);
    
            $invitationLink = url('/users/register?token=' . $token);
    
            Mail::to($email)->send(new InviteEmployee($invitationLink));
        } 
        else {
            // Check if the user is a normal user
            if ($user->role === 'normal user') {
                $manager = Auth::user();
                $token = Str::random(32); // Generate a unique token for the invitation link
    
                // Save the token and manager's ID in the managers_employees table
                ManagersEmployees::create([
                    'managers_id' => $manager->id,
                    'token' => $token,
                    'email' => $email,
                ]);
    
                // Send email to the user with the invitation link
                $invitationLink = url('/login?token=' . $token);
    
                Mail::to($email)->send(new InviteEmployee($invitationLink));
            } else {
                return redirect()->route('company')->with('error', 'This email belongs to a manager');
            }
        }

        return redirect('/manager/add_role');
    }

   
}
