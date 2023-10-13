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


class ForgetPasswordController extends Controller
{
    function viewForgetPassword(){
        return view ("forget-password");
    }

    function forgetPassword(Request $request){
        $request->validate([
            'email_address' => 'required|email|exists:user'
        ]);

        $token = Str::random(64);

        DB::table('passwordreset')->insert([
            'email_address' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forget-password", ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("RESET PASSWORD");
        });

        return redirect()->to(route("forget-password"))->with("success", "We have sent an email to reset password");
    }
        

    

    function reset($token){
        return view ('new-password', compact('token'));
    }

    function resetpassword(Request $request){
        $request->validate([
            'email_address' => 'requires|email|exists:user',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|required_with:password|same:password'
        ]);

        $rp = DB::table('passwordreset')->where([
            'email_address'=> $request->email,
            'token' => $request->token
        ])->first();

        if(!rp){
            return redirect()->to(route('reset-password'))->with("error", "There is something wrong.");
        }
        User::where('email', $request->email)->update(['password' =>Hash::make($request->password)]);

        DB::table('passwordresest')->where(['email' => $request->email])->delete();
        return redirect()->to(route('login'))->with("success", "Password successfully changed.");

    }
}
