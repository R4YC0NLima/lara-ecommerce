<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class TwilioService 
{
    public $token;
    public $twilio_sid;
    public $twilio_verify_sid;
    public $twilio;
    public function __construct()
    {
        $this->token                = config('services.twilio.auth_token', env('TWILIO_AUTH_TOKEN'));
        $this->twilio_sid           = config('services.twilio.account_sid', env('TWILIO_ACCOUNT_SID'));
        $this->twilio_verify_sid    = config('services.twilio.verification_sid', env('TWILIO_VERIFICATION_SID'));
        $this->twilio               = new Client($this->twilio_sid, $this->token);
    }

    public function sendTwilioSMS($phoneNumber)
    {
        $this->twilio->verify->v2->services($this->twilio_verify_sid)
            ->verifications
            ->create($phoneNumber, "sms");
    }

    public function sendCodeVerification($data)
    {
        $verification = $this->twilio->verify->v2->services($this->twilio_verify_sid)
            ->verificationChecks
            ->create($data['verification_code'], array('to' => $data['phone_number']));

        return $verification;
    }
}