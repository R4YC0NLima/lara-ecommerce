<?php

 

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract

{

    /**

     * Create an HTTP response that represents the object.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Symfony\Component\HttpFoundation\Response

     */

    public function toResponse($request)
    {
        $home = auth()->user()->profile == 'administrator' ? '/admin/dashboard' : '/produtos';
        
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended($home);

    }

}