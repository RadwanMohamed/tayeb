<?php

namespace App\Http\Controllers\Api\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $rules = [

            'name' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ];
        $this->validate($request, $rules);
        Mail::raw($request->message, function ($message) use($request) {
            $message->to('6544743@gmail.com')->subject($request->subject);
        });
    }


}
