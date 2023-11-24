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
        $d->account_status = "Active";
        $d->save();
        return redirect()->back()->with('success', 'User Validated.');}

    
    public function denyUser($UID) {
        $d = User::where('id', $UID)->first();
        $d->isValid = 1;
        $d->account_status = "Denied";
        $d->save();
        return redirect()->back()->with('success', 'User Denied.');}

    public function banUser($UID) {
        $d = User::where('id', $UID)->first();
        $d->account_status = "Banned";
        $d->save();


        if($d->usertype == "Provider"){
            $pendingBookings = Book::where('service_id', $d->id)
            ->where('status', 'Pending' ,'Accepted')
            ->get();
             foreach ($pendingBookings as $booking) {
                $booking->status = "Declined";
                $booking->save();}
                return redirect()->back()->with('success', 'User Banned.');
        }
      

        return redirect()->back()->with('success', 'User Banned.');}


    public function suspendService($UID) {
        $d = Service::where('id', $UID)->first();
        $d->status = "Deleted";
        $d->save();

        $pendingBookings = Book::where('service_id', $d->id)
        ->where('status', 'Pending', 'Accepted')
        ->get();
         foreach ($pendingBookings as $booking) {
            $booking->status = "Declined";
            $booking->save();}

            return redirect()->back()->with('success', 'Service suspend.');}

//fOR USER SORTING
   public function verifiedUsers(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
             
        $verified = User::where('account_status', '=', "Active")
        ->get();
        
            
        return view('admin.adminhome', compact('verified','user'));}}
    
    public function unverifiedUsers(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
             
        $verified = User::where('account_status', '=', "Pending")
        ->get();
        
            
        return view('admin.adminhome', compact('verified','user'));}}

    public function deniedUsers(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
             
        $verified = User::where('account_status', '=', "Denied")
        ->get();
        
            
        return view('admin.adminhome', compact('verified','user'));}}

    public function bannedUsers(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
             
        $verified = User::where('account_status', '=', "Banned")
        ->get();
        
            
        return view('admin.adminhome', compact('verified','user'));}}



    
}
    
    
