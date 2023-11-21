<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class DeniedUserController extends Controller
{
    function viewSendLink(){
        return view ("resend-proof.rproof");
    }

    function getEmail(Request $request){
        $request->validate([
            'email' => 'required|email|exists:user,email_address' 
        ]);
    

        $user = User::where('email_address', $request->email)->first();
    
        if (!$user) {
            return back()->with('error', 'Email does not exist');
        }
        $existingToken = DB::table('denies')
        ->where('email', $request->email)
        ->first();

    if ($existingToken) {
        return back()->with('error', 'Reset link already sent for this email. Please check your email.');
    }
        $token = Str::random(64);
    
        DB::table('denies')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    
        $SENT = Mail::send("emails.emailsresendproof", ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("REREGISTRATION");
        });
    
        
            return redirect()->to(route("resend"))->with("success", "We have sent the reregistration link to your email.");
        
    }
    
        

    

    function reregister($token){
        return view ('resend-proof.resendproof', compact('token'));
    }

    function reregisterAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user,email_address', // Correct table name 'users'
            'id_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'token' => 'required',
        ]);
    
        // Check if the token exists in the 'denies' table
        $tokenExists = DB::table('denies')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first(); // Retrieve the entry
    
        if (!$tokenExists) {
            return back()->with("error", "Invalid token or email.");
        }
    
        // Handle the image upload
        if ($request->hasFile('id_img')) {
            $image = $request->file('id_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Move and save the image
        }
    
        // Update the 'id_img' column in the 'users' table
        User::where('email_address', $request->email)
            ->update(['id_img' => $imageName,
                    'account_status' => 'Pending',
                    'isValid' => '0',
        ]);
    
        // Delete the entry from the 'denies' table
        DB::table('denies')->where(['email' => $request->email])->delete();
    
        return redirect("login")->with("success", "Reregistration successful! Please wait for your account to be verified.");
    }
    
}
