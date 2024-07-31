<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OTP;
use App\Models\User;
use App\Models\CountryCode;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DRController extends Controller
{
   
    public function sendOTP1(Request $request)
    {
       // echo "hello";die();
    

        $request->validate([
            'phone' => 'required|numeric',
        ]);
    
        $phone = $request->input('phone');
    

        $otp = rand(100000, 999999);
    

        OTP::create([
            'phone' => $phone,
            'otp' => $otp,
        ]);
    
        return response()->json(['status'=>'True','message' => 'OTP Sent Successfully.', 'OTP' => $otp]);
    }
    
    public function verifyOTP(Request $request)
    {  

     
        $request->validate([
            'phone' => 'required',
            'otp' => 'required',
        ]);
    
        $phone = $request->input('phone');
        $otp = $request->input('otp');
    

        $otpEntry = OTP::where('phone', $phone)->latest()->first();
    
        if ($otpEntry && $otpEntry->otp == $otp) {

            $user = User::firstOrCreate(['phone' => $phone]);
    

            $token = $user->createToken('auth_token')->plainTextToken;
            $request->session()->put('verified_phone', $phone);
            return response()->json([
                'status'=>'True','message' => 'OTP verified successfully.',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } else {
            return response()->json(['status'=>'False','message' => 'Invalid OTP.'], 401);
        }
    }
    public function page()
    {
        return view('page'); 
    }
    public function sendOTP11(){
        echo "hello";die();
        return view('page');
    }


   
    public function register1(Request $request)
    {  
        // Check if the phone number is verified
        $phone = $request->session()->get('verified_phone');
        if (!$phone) {
            return response()->json(['status'=>'False','message' => 'Phone number not verified.'], 401);
        }
    
      //  Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
        ]);
       // echo "hello";die();
        // Check if the user with the given phone number already exists
        $user = User::where('phone', $phone)->first();
    
        if ($user) {
            // Check if the name, email, and address fields are not empty for the existing user
            if (!empty($user->name) && !empty($user->email) && !empty($user->address)) {
                return response()->json(['status'=>'False','message' => 'Customer already registered.'], 409);
            }
    
            // Check if the email already exists in the database
            $emailExists = User::where('email', $validatedData['email'])->exists();
            if ($emailExists) {
                return response()->json(['status'=>'False','message' => 'Email already exists.'], 409);
            }
    
            // Update the user details
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
            ]);
        } else {
            return response()->json(['status'=>'False','message' => 'User not found.'], 404);
        }
    
        // Assign the 'customer' role
        $role = Role::where('name', 'customer')->first();
        if ($role) {
            $user->assignRole($role);
            $user->role_id = $role->id; // Update the role_id in the users table
            $user->save();
        } else {
            return response()->json(['status'=>'False','message' => 'Role not found.'], 404);
        }
    
        // Generate an access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;
    
        // Remove the phone number from the session
        $request->session()->forget('verified_phone');
    
        return response()->json(['status'=>'True',
            'message' => 'User registered successfully.',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    

    public function CountryCode()
    {
        $countryCodes = CountryCode::all();
        return response()->json($countryCodes);
    }

   
}
