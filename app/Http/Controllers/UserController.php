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

class UserController extends Controller
{
   
    public function home(){ //added
        $user = null; 
        $services = Service::where('status', 'AVAILABLE')->get();
    
        if (Session::has('loginID')) {
            $id = Session::get('loginID');
            $user = User::where('id', $id)->first();
        }
    
        return view('home', compact('services', 'user'));
    }

    public function gohome(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',]);

        $user = User::where('username', $request->username)->orWhere('email_address', $request->username)->first();
        if ($user && $user->isValid == 1) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginID', $user->id);
                if ($user->usertype === 'Provider') {
                return redirect()->route('provserv')->with(compact('user'));}
                else if ($user->usertype === 'Customer'){
                    return redirect()->route('customer-home')->with(compact('user'));}
                else{
                    return redirect()->route('admin')->with(compact('user'));
                }}
            else {
                return back()->with('error', 'Invalid Credentials', compact('user'));}}
        else {
            return back()->with('error', 'Invalid Credentials', compact('user'));}}

    
    public function register(Request $request){
        $request->validate([
            'firstname' => 'required|regex:/^([^0-9]*)$/',
            'lastname' => 'required|regex:/^([^0-9]*)$/',
            'gender' => 'required',
            'birthday' => 'required|date',
            'address' => 'required',  
            'city' => 'required',
            'contact' => 'required|numeric',
            'usertype' => 'required',
            'service_name' => ($request->input('usertype') === 'Provider') ? 'required|unique:user' : '',
            'email_address' => 'required|email|unique:user', 
            'username' => 'required|string|max:255|unique:user|regex:/^\S*$/u|alpha_dash',
            'password' => 'required|min:8|confirmed',
            'id_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password_confirmation' => 'required|required_with:password|same:password',
                ]);
            
                $user = new User();
                $user->username = $request->input('username');
                $user->email_address = $request->input('email_address');
                $user->password = Hash::make($request->input('password'));
                $user->firstname = $request->input('firstname');
                $user->lastname = $request->input('lastname');
                $user->gender = $request->input('gender');
                $user->birthday = $request->input('birthday');
                $user->address = $request->input('address');
                $user->city = $request->input('city');
                $user->contact = $request->input('contact');
                $user->usertype = $request->input('usertype');


                if ($request->hasFile('id_img')) {
                    $image = $request->file('id_img');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('assets/', $imageName);
                    $user->id_img = $imageName;
                    $request->id_img->move(public_path('images'), $imageName);
                }

               /* if ($request->hasFile('id_img')) {
                    $image = $request->file('id_img');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('your_disk_name', 'assets/' . $imageName); // Specify your disk name
                    $user->id_img = $imageName;
                }*/
            
                if ($request->input('usertype') === 'Customer') {
                    $user->service_name = null;
                } elseif ($request->input('usertype') === 'Provider') {
                    $user->service_name = $request->input('service_name');
                }
            
                $user->account_status = "Active";
                $user->isValid = 1;
                $saveuser = $user->save();
            
                if ($saveuser) {
                    return redirect("login")->with('success', 'You have successfully registered.');
                } else {
                    return back()->with('error', 'There is an error. Please try again.');
                }
            }
            

    //PROVIDER
    public function provserv(){
        if (Session::has('loginID')) {
            $id = Session::get('loginID');
            $user = User::find($id);
            $services = Service::where('user_id', '=', $id)->get();
            return view('provider.providerServices', compact('user', 'services'));}}      
                
    public function provacc(){
        $user = array();
        if(Session::has('loginID')){
            $id = Session::get('loginID');
            $services = Service::where('user_id', '=', $id)->where('status', 'AVAILABLE')->get();
            $user = User::where('id', '=', $id)->first();  
            return view('provider.providerprofile',  compact('user','services'));}}  

    public function viewprovacc($id){
        $user = User::find($id);
        $services = Service::where('user_id', '=', $id)->where('status', 'AVAILABLE')->get();
        return view('provider.customerviewprovprofile', compact('user', 'services'));}


    /*public function viewAllbookingrequests() {

            $u = null;
                
            if (Session::has('loginID')) {
            $id = Session::get('loginID');
            $u = User::where('id', $id)->first();
            }
                
        if ($u) {
            $bookings = Book::where('user_id_provider', $u->id)
            ->orderBy('date', 'asc') 
            ->get();
            $services = Service::whereIn('user_id', $bookings->pluck('user_id_provider'))->get();
            $cIds = $services->pluck('user_id_customer')->toArray();

            $up = User::whereIn('id', $cIds)->get();       
            return view('provider.providerBooking', compact('u', 'bookings', 'services', 'up'));
            }
                
                }
*/

//trial for booking request handling
    public function viewAllbookingrequests() {
        $u = null;
        if (Session::has('loginID')) {
            $id = Session::get('loginID');
            $u = User::where('id', $id)->first();}
        if ($u) {
            $validStatus = ['Accepted', 'Declined', 'Pending', 'Cancelled', 'Fulfilled'];
            $bookings = Book::where('user_id_provider', $u->id)->whereIn('status', $validStatus)->orderBy('date', 'asc')->get();
            $services = Service::whereIn('user_id', $bookings->pluck('user_id_provider'))->get();
            $cIds = $services->pluck('user_id_customer')->toArray();
            $up = User::whereIn('id', $cIds)->get();
            return view('provider.providerBooking', compact('u', 'bookings', 'services', 'up'));} }
   
    public function ProvEditP(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        return view('provider.editprofile',  compact('user'));}   }  
        
    public function startServiceVIEW(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        return view('provider.ProviderAddService',  compact('user'));}  }    

    public function pChangepw(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        return view('provider.changepw',  compact('user'));}  }        

    public function updateProvProfile(Request $request, $id){
        $request->validate([
            'firstname' => 'required|regex:/^([^0-9]*)$/',
            'lastname' => 'required|regex:/^([^0-9]*)$/',
            'gender' => 'required',
            'birthday' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required',
            'city' => 'required',
            'contact' => 'required|numeric',
            'service_name' => 'required|unique:user,service_name,'.$id,
            'email_address' => 'required|email|unique:user,email_address,'.$id,
            'username' => 'required|string|max:255|unique:user,username,'.$id.'|regex:/^\S*$/u|alpha_dash',]);
    
        $save = User::find($id);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('assets/', $imageName);
            $save->profile_picture = $imageName;
            $request->profile_picture->move(public_path('images'), $imageName);
        }

            $save->firstname = $request->input('firstname');
            $save->lastname = $request->input('lastname');
            $save->gender = $request->input('gender');
            $save->birthday = $request->input('birthday');
            $save->address = $request->input('address');
            $save->city = $request->input('city');
            $save->contact = $request->input('contact');
            $save->email_address = $request->input('email_address');
            $save->service_name = $request->input('service_name');
            $save->username = $request->input('username');

            $save->save();

            return back()->with('success', 'Account changed successfully!');} 
    

    public function makeService(Request $request){ //MODIFIED
        $request->validate([
            'service_list_name' => 'required|regex:/^([^0-9]*)$/',
            'user_id' => 'required',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
            'gcashnum' => 'nullable|numeric', 
            'photo' => 'required|image|mimes:jpeg,png,gif|max:2048',
            'category' => 'required',
        ]);

        $imgName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images'), $imgName);
        
        if ($request->gcashnum == null){
            $request->gcashnum = 'n/a';
        }

            $s = new Service;
            $s->service_list_name = $request->service_list_name;
            $s->user_id = $request->user_id;
            $s->price = $request->price;
            $s->description = $request->description;
            $s->gcashnum = $request->gcashnum;
            $s->category = $request->category;
            $s->photo = $imgName;
            $s->status = 'AVAILABLE';
            $s->save();

            $check = $s->save();


            if ($check) {
                return redirect('/provserv')->with('success', 'Service added successfully.');
            } else {
                return back()->with('fail', 'There was an error, try again!');}}


    public function updateService(Request $request, $id){ //MODIFIED
        $request->validate([
            'service_list_name' => 'required|regex:/^([^0-9]*)$/',
            'price' => 'required|numeric|min:1',
            'description' => 'nullable',
            'gcashnum' => 'nullable|numeric', 
            'category' => 'required', 
            'photo' => 'nullable|image|mimes:jpeg,png,gif|max:2048',]);
        
            
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('assets/', $imageName);
                $save->photo = $imageName;
                $request->photo->move(public_path('images'), $imageName);
            }
            
            if (empty($request->gcashnum)) {
                $request->gcashnum = 'n/a';
            }
            
            $save = Service::find($id);
            $save->service_list_name = $request->input('service_list_name');
            $save->price = $request->input('price');
            $save->description = $request->input('description');
            $save->gcashnum = $request->gcashnum;
            $save->category = $request->category;
             $save->save();
            
                return redirect('/provserv')->with('success', 'Service successfully updated.');   } 


    public function setUnavailableService($serviceID) {
        $d = Service::where('id', $serviceID)->first();
        $d->status = "UNAVAILABLE";
        $d->save();

        $pendingBookings = Book::where('service_id', $d->id)
        ->where('status', 'Pending')
        ->get();
         foreach ($pendingBookings as $booking) {
            $booking->status = "Declined";
            $booking->save();}
    return redirect()->back()->with('success', 'Service is now made unavailable, and pending bookings have been declined.');}


    public function setAvailableService($serviceID) {
        $d = Service::where('id', $serviceID)->first();
        $d->status = "AVAILABLE";
        $d->save();
    return redirect()->back()->with('success', 'Service is now made available.');}

    public function deleteAService($serviceID) {
        $d = Service::where('id', $serviceID)->first();
        $d->status = "Deleted";
        $d->save();

        $pendingBookings = Book::where('service_id', $d->id)
        ->where('status', 'Pending')
        ->get();
         foreach ($pendingBookings as $booking) {
            $booking->status = "Declined";
            $booking->save();}
    return redirect()->back()->with('success', 'Service is now deleted, and pending bookings have been declined.');}

    public function acceptBookedService($bookingID) {
        $a = book::where('id', $bookingID)->first();
        $a->status = "Accepted";
        $a->save();
    return redirect()->back()->with('success', 'Booking accepted.');}


    public function declineBookedService($bookingID) {
        $d = book::where('id', $bookingID)->first();
        $d->status = "Declined";
        $d->save();
    return redirect()->back()->with('success', 'Booking cancelled.');}


    public function FulfillBookedService($bookingID) {
        $d = book::where('id', $bookingID)->first();
        $d->status = "Fulfilled";
        $d->save();
    return redirect()->back()->with('success', 'Booking is Fulfilled.');}


//not yet tried
    public function ProvConfirmPaymentReceipt(Request $request, $id){
        $request->validate([
            'payment_status' => 'required',]);
                $book = Book::find($id);
                $book->payment_status = $request->payment_status;
                $book->save();
        return redirect()->back()->with('success', 'Payment Confirmed');}
        
    public function paidBooking($bookingID) {
        $a = book::where('id', $bookingID)->first();
        $a->payment_status = "Paid";
        $a->save();
        return redirect()->back()->with('success', 'Booking is paid.');}
    
    public function notpaidBooking($bookingID) {
        $a = book::where('id', $bookingID)->first();
        $a->payment_status = "Not Paid";
        $a->save();
        return redirect()->back()->with('success', 'Booking is paid.');}

    public function reviewCustomer($bookingID) {
           // $a = book::where('id', $bookingID)->first();
           // $a->payment_status = "Paid";
            //$a->save();
            
           // return redirect()->back()->with('success', 'Booking is paid.');
        }



//not yet tried
    public function ProvPaymentReceiptDisplay($id){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        $b = Book::where('user_id_provider', '=', $user)->first();  
        return view('provider.PaymentReceipt', compact('b','user'));}}


    public function changeServiceNameView(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        $services= Service::where('user_id', '=', $user)->first();  
        return view('provider.changeSN',  compact('user','services'));}  } 


    public function updateServiceName(Request $request, $id){
        $request->validate([
                'service_name' => 'required|unique:user',]);
        $user = User::find($id);
        $user->service_name =$request->service_name;
       
        $saveuser = $user->save();
            
                if ($saveuser) {
                    return redirect('provserv')->with('success', 'Service name changed successfully.');
                } else {
                    return back()->with('error', 'There is an error. Please try again.');
                }
    }  

    public function editServiceView($sID) {
        $user = array();
        if (Session::has('loginID')) {
            $id = Session::get('loginID');
            $user = User::where('id', '=', $id)->first();  
            $services = Service::find($sID);
        if (!$services) {
                return back()->with('fail', 'Service not found.');}
            return view('provider.editService', compact('user', 'services'));}
            else {
                return redirect()->route('login')->with('error', 'You must be logged in to access this page.'); }}
        
    public function addCrev(Request $request, $id) {
        $request->validate([
            'rating' => 'required', 
            'comments' => 'required',]);
             $booking = Book::findOrFail($id);
             $rating = new Rate();
                $rating->booking_id = $booking->id;
                $rating->user_id_reviewer = $booking->user_id_provider; 
                $rating->user_id_recipient = $booking->user_id_customer; 
                $rating->rating = $request->rating;
                $rating->comments = $request->comments;
                
                    $rating->save();
                
                    return redirect()->back()->with('success', 'Rating submitted successfully');  }
                
                
  

//CUSTOMER

    public function cHome(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        return view('customer.custhome',  compact('user'));}    }
            
    public function custacc(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        return view('customer.custprofile',  compact('user'));}   }

    public function viewcusvacc($id){
        $user = User::find($id);
        $services = Book::where('user_id_customer', $id)->get();
        return view('customer.provviewcustomerprofile', compact('user', 'services')); }

    public function cChangepw(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        return view('customer.changePW',  compact('user'));}  } 
        
    public function CustEditP(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        return view('customer.editprofile',  compact('user'));}   }  

    public function makebooking($id){
        $user = array();
        if (Session::has('loginID')) {
        $userId = Session::get('loginID');
        $user = User::where('id', '=', $userId)->first();
        $service = Service::where('id', '=', $id)->first();
        return view('customer.makebooking', compact('user', 'service')); }}

    public function bookservice(Request $request, $id) {
        $request->validate([
            'service_id' => 'required',
            'user_id_provider' => 'required',
            'user_id_customer' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'payment_type' => 'required']);
            
            $service = Service::findOrFail($id);
            $user_id_provider = $request->user_id_provider;
            $user_id_customer = $request->user_id_customer;


            $provider = Service::where('user_id', '=', $user_id_provider)->first();
            $customer = User::findOrFail($user_id_customer);
                
                $booking = new Book();
                $booking->service_id = $service->id;
                $booking->user_id_customer = $customer->id;
                $booking->user_id_provider = $provider->user_id;
                $booking->date = $request->date;
                $booking->time = $request->time;
                $booking->location = $request->location;
                $booking->status = 'Pending';
                $booking->payment_type = $request->payment_type;

                if($request->payment_type == "o")
                   {
                    $booking->refno = null; 
                } else{
                    $booking->refno = '0'; 
                }

                    $booking->payment_status = 'Not Paid';
                    $submit = $booking->save();
            
                    if ($submit) {
                       return back()->with('success', 'Booking made!');}
                        else {
                       return back()->with('error', 'There is an error. Try again.');  } }
    
    
    public function viewbooking() {
        $u = null;
        if (Session::has('loginID')) {
            $id = Session::get('loginID');
            $u = User::where('id', $id)->first();}        
        if ($u) {
            $bookings = Book::where('user_id_customer', $u->id)->orderBy('date', 'asc')->orderBy('time', 'asc')->get();
            $services = Service::whereIn('user_id', $bookings->pluck('user_id_provider'))->get();
            $providerIds = $services->pluck('user_id_provider')->toArray();

            $up = User::whereIn('id', $providerIds)->get();              
            return view('customer.custbookings', compact('u', 'bookings', 'services', 'up'));}}
                
                
 
//not yet tried
    public function cancelBookedService($bookingID) {
        $cancel = book::where('id', $bookingID)->first();
        $cancel->status = "Cancelled";
        $cancel->save();
        return redirect()->back()->with('success', 'Booking cancelled.');}

//not yet tried


    public function CustconfirmPayment(Request $request, $id){
     $request->validate([
                'refno' => 'required',]);
            $book = book::where('id', $id)->first();
        
            $book->refno = $request->input('refno');
            $book->save();
       return redirect()->back()->with('success', 'Reference Number updated');
    }  
                          
    public function updateCusProfile(Request $request, $id){
        $request->validate([
            'firstname' => 'required|regex:/^([^0-9]*)$/',
            'lastname' => 'required|regex:/^([^0-9]*)$/',
            'gender' => 'required',
            'birthday' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'required',
            'contact' => 'required|numeric',
            'email_address' => 'required|email|unique:user,email_address,'.$id,
            'username' => 'required|string|max:255|unique:user,username,'.$id.'|regex:/^\S*$/u|alpha_dash',
            ]);
    
            $save = User::find($id);
    
            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('assets/', $imageName);
                $save->profile_picture = $imageName;
                $request->profile_picture->move(public_path('images'), $imageName);
            }
    
            $save->firstname = $request->input('firstname');
            $save->lastname = $request->input('lastname');
            $save->gender = $request->input('gender');
            $save->birthday = $request->input('birthday');
            $save->address = $request->input('address');
            $save->contact = $request->input('contact');
            $save->email_address = $request->input('email_address');
            $save->username = $request->input('username');
    
            $save->save();
    
            return back()->with('success', 'Account changed successfully!');}                         

    public function reviewProvider(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();
        $bookings = book::where ('user_id_customer', '=','$user' )->get();
        return view('customer.custOGFbacks',  compact('user', 'bookings'));}  }

   public function addPrev(Request $request, $id) {
    $request->validate([
        'rating' => 'required', 
        'comments' => 'required',]);
         $booking = Book::findOrFail($id);
         $rating = new Rate();
            $rating->booking_id = $booking->id;
            $rating->user_id_reviewer = $booking->user_id_customer; 
            $rating->user_id_recipient = $booking->user_id_provider; 
            $rating->rating = $request->rating;
            $rating->comments = $request->comments;
            
                $rating->save();
            
                return redirect()->back()->with('success', 'Rating submitted successfully');  }
    
//FUNCTIONS
    public function updatePassword(Request $request, $id){
        $request->validate([
            'password' => 'required',
            'npassword' => 'required|min:8',
            'password_confirmation' => 'required|required_with:npassword|same:npassword']);

        $user = User::find($id);

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Incorrect current password');}

        $user->password = Hash::make($request->npassword);
        
        $user->save();
        return redirect()->back()->with('success', 'Password changed successfully');}  

    public function displayServices(){
        $user = array();
        if(Session::has('loginID')){
        $id = Session::get('loginID');
        $user = User::where('id', '=', $id)->first();  
        $services = Service::where('status' , 'AVAILABLE')->get();
        return view('customer.custservices', compact('services','user'));}}
 
    public function logout(){
        if(Session::has('loginID')){
            Session::pull('loginID');
        return Redirect('/login')->with('msg', 'Logged out successfully');}}


        
    }
        

