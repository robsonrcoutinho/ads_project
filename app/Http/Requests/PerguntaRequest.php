<?php

namespace adsproject\Http\Requests;

use adsproject\Http\Requests\Request;

class PerguntaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'enunciado'=>'required'
        ];
    }
}
