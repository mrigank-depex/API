<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class API extends Controller
{
    public function sendOTP(Request $request)
    {  echo "hello";die();
        // Validate the request
        $request->validate([
            'phone' => 'required',
        ]);

        $phone = $request->input('phone');
      
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
   echo $phone;
   echo $otp;
   die();
        // Store OTP in the database
        OTP::create([
            'phone' => $phone,
            'otp' => $otp,
        ]);

        // Send OTP via Twilio
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');
        $client = new Client($sid, $token);

        $message = "Your OTP code is: " . $otp;

        try {
            $client->messages->create($phone, [
                'from' => $twilioNumber,
                'body' => $message,
            ]);

            return response()->json(['message' => 'OTP sent successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send OTP.', 'error' => $e->getMessage()], 500);
        }
    }

    public function verifyOTP(Request $request)
    {
        // Validate the request
        $request->validate([
            'phone' => 'required',
            'otp' => 'required',
        ]);

        $phone = $request->input('phone');
        $otp = $request->input('otp');

        // Retrieve the latest OTP entry for the phone number
        $otpEntry = OTP::where('phone', $phone)->latest()->first();

        if ($otpEntry && $otpEntry->otp == $otp) {
            return response()->json(['message' => 'OTP verified successfully.']);
        } else {
            return response()->json(['message' => 'Invalid OTP.'], 401);
        }
    }
    public function page111111()
    {
        return view('page'); // 'page' is the name of your view file (resources/views/page.blade.php)
    }
}
