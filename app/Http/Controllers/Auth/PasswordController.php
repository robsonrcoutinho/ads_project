<?php

namespace adsproject\Http\Controllers\Auth;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Config;
use Mail;
use Illuminate\Http\Request;
use adsproject\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    protected $redirectTo = '/';
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postEmail(Request $request)
    {
        $rota=route('password.reset');
        $rota.=$request->_token;

        //dd($rota);
        //$rota = \Route::'emails.password';
        mail($request->email,'Redefinição de senha',$rota);
            /*echo $rota.'/'.$request->_token;
            endif;
        /*$transport  = Swift_SmtpTransport :: newInstance (Config::get('mail.username') ,  25 ,
            'starttls' )
            -> setUsername (Config::get('mail.username'))
            -> setPassword (Config::get('mail.password')) ;

        $mailer  = Swift_Mailer :: newInstance ( $transport ) ;
        $message  = Swift_Message :: newInstance ( 'title' ,  'emails.password' ,  'text/html' )
            -> setFrom( Config::get('mail.username'))
            -> setTo($request->email);

        Mail::send($message) ;
        //dd(\Config::get('mail.username'));
        /*$token = $request->_token;
        $email = $request->email;
        //dd($request->all());
                Mail::send('emails.password', ['token' => $token], function ($m) use ($email) {
            $m->from(\Config::get('mail.username'), 'Meu');
            $m->to($email)->subject('Redefinição de senha');
            //dd($m);
        });*/
    }
}

//postReset