<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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

    function forgetPassword(Request $request){
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
    
        
            return redirect()->to(route("#"))->with("success", "We have sent the reregistration link to your email.");
        
    }
    
        

    

    function reset($token){
        return view ('resend-proof.resendproof', compact('token'));
    }

    function resetpassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:User,email_address',
            'id_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
          
        ]);

        $rp = DB::table('denies')->where([
            'email'=> $request->email,
            'token' => $request->token
        ])->first();

        if(!$rp){
            return back()->with("error", "There is something wrong.");
        }
        User::where('email_address', $request->email)->update('id_img', $request->id_img);

        DB::table('denies')->where(['email' => $request->email])->delete();
        return redirect("login")->with("success", "Reregistration sucessful! Please wait for your account to be verified.");

    }
}
