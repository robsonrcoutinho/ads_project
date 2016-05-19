<?php

namespace adsproject\Http\Controllers;

use adsproject\Token;
use adsproject\Http\Requests\TokenRequest;
use Illuminate\Support\Facades\Input;


class TokenController extends Controller
{

    public function salvarToken()
    {
        Token::create(Input::all());
    }
}
