<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Book;
use App\Models\Rate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function home(){
        return view('admin/adminhome');
    }

    public function displayUsers(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        $users = user::all();
        return view('admin.adminhome', compact('users','user'));}}
    

    public function displayBookings(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        $b = Book::all();
        return view('admin.adminhome', compact('b','user'));}}
    

    public function displayServices(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        $services = Service::all();
        return view('admin.adminhome', compact('services','user'));}}

    public function displayRating(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        $r = rate::all();
        return view('admin.adminhome', compact('r','user'));}}


    public function verifyUser($UID) {
        $d = User::where('id', $UID)->first();
        $d->isValid = 1;
        $d->save();
        return redirect()->back()->with('success', 'User Validated.');}

    
    public function denyUser($UID) {
        $d = User::where('id', $UID)->first();
        $d->account_status = "Denied";
        $d->save();
        return redirect()->back()->with('success', 'User Denied.');}

    public function banUser($UID) {
        $d = User::where('id', $UID)->first();
        $d->account_status = "Banned";
        $d->save();
        return redirect()->back()->with('success', 'User Banned.');}
}
    
    
