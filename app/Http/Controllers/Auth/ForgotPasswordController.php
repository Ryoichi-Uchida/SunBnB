<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    //It's override from SendsPasswordResetEmails(Adding toastr).
    protected function sendResetLinkResponse(Request $request, $response)
    {
        toastr()->info("Please check Email from us!");

        return back()->with('status', trans($response));
    }

    //It's override from SendsPasswordResetEmails(Adding toastr).
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        toastr()->error("The Email is not registered!");

        return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
    }
}
