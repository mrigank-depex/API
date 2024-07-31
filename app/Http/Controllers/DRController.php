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
   
    public function sendOTP(Request $request)
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
    
        return response()->json(['message' => 'OTP Sent Successfully.', 'OTP' => $otp,'status'=>'True']);
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
            $request->session()->put('verifi_phone', $phone);
            return response()->json([
                'message' => 'OTP verified successfully.',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } else {
            return response()->json(['message' => 'Invalid OTP.'], 401);
        }
    }

   
    public function register1(Request $request)
    {
        // Check if the phone number is verified
        $phone = $request->session()->get('verifi_phone');
        if (!$phone) {
            return response()->json(['message' => 'Phone number not verified.'], 401);
        }

        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
        ]);

        // Find the user by phone number
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Update the user details
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
        ]);

        // Assign the 'customer' role
        $role = Role::where('name', 'driver')->first();
        $user->assignRole($role);
        $user->role_id = $role->id; // Update the role_id in the users table
        $user->save();

        // Generate an access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Remove the phone number from the session
        $request->session()->forget('verified_phone');

        return response()->json([
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
