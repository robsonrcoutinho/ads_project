<?php

namespace adsproject\Http\Controllers;

use adsproject\Token;
use adsproject\Http\Requests\TokenRequest;


class TokenController extends Controller
{

    public function salvarToken(TokenRequest $request){

        dd($request);
        $input = $request->all();
        $token = new Token();
        $token->content =$input;
        $token->save();


/*
        $token = $request->all();
        Token::create($token);*/
    }
}
