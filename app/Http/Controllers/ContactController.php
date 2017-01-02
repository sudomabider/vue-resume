<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 2/01/17
 * Time: 12:23 PM
 */

namespace App\Http\Controllers;


use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function post(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'recaptcharesponse' => 'required|captcha'
        ]);

        Mail::to(config('mail.address'))
            ->send(new ContactMessage($request->only('name', 'email', 'message'), true));

        Mail::to($request->input('email'))
            ->send(new ContactMessage($request->only('name', 'email', 'message'), false));

        return 'Message received';
    }
}