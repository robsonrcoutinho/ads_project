<?php

namespace adsproject\Http\Controllers;

use adsproject\Token;
use Illuminate\Support\Facades\Input;


class TokenController extends Controller
{

    public function salvarToken()
    {
        Token::create(Input::all());
    }
}
