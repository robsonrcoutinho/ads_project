<?php

namespace adsproject\Http\Requests;

use adsproject\Http\Requests\Request;

class AvisoRequest extends Request
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
            'titulo' => 'required|max:20',
            'mensagem' => 'required|max:255'
        ];
    }
}
