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


class ForgetPasswordController extends Controller
{
    function viewForgetPassword(){
        return view ("forget-password");
    }

    function forgetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:user,email_address' 
        ]);
    

        $user = User::where('email_address', $request->email)->first();
    
        if (!$user) {
            return back()->with('error', 'Email does not exist');
        }
        $existingToken = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->first();

    if ($existingToken) {
        return back()->with('error', 'Reset link already sent for this email. Please check your email.');
    }
        $token = Str::random(64);
    
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    
        $SENT = Mail::send("emails.forget-password", ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("RESET PASSWORD");
        });
    
        
            return redirect()->to(route("forget-password"))->with("success", "We have sent the reset link to your email.");
        
    }
    
        

    

    function reset($token){
        return view ('new-password', compact('token'));
    }

    function resetpassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:User,email_address',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        $rp = DB::table('password_reset_tokens')->where([
            'email'=> $request->email,
            'token' => $request->token
        ])->first();

        if(!$rp){
            return back()->with("error", "There is something wrong.");
        }
        User::where('email_address', $request->email)->update(['password' =>Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        return redirect("login")->with("success", "Password successfully changed.");

    }
}
