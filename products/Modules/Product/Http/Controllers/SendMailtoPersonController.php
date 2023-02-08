<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Product\Emails\NotifyMail;

class SendMailtoPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public static function index($email)
    {

        Mail::to($email)->send(new NotifyMail());

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->success('Great! Successfully send in your mail');
        }
    }


}
