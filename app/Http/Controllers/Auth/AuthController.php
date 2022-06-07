<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function create(UserFormRequest $request)
    {
        $newUser    = new CreateNewUser();
        $data       = $request->all();

        (new TwilioService())->sendTwilioSMS($data['phone_number']);

        $newUser->create($data);
        
        return redirect()->route('verify')->with(['phoneNumber' => $data['phone_number']]);
    }

    public function verifyCode()
    {
        return Inertia::render('Auth/VerifyNumber', [
            'phoneNumber' => session()->get('phoneNumber')
        ]);
    }

    public function verify(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number'      => ['required', 'string'],
        ]);

        $verification = (new TwilioService())->sendCodeVerification($data);

        if ($verification->valid) {
            $user = tap(User::where('phone_number', $data['phone_number']))->update(['isVerified' => true]);
            /* Authenticate user */
            Auth::login($user->first());

            $home = auth()->user()->profile == 'user' ? 'products.index' : 'dashboard' ;

            return redirect()->route($home)->with(['message' => 'Phone number verified']);
        }

        return back()->with(['phone_number' => $data['phone_number'], 'error' => 'Invalid verification code entered!']);
    }
}
