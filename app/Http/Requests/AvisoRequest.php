<?php

namespace adsproject\Http\Requests;

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
            'titulo'=>'required|min:5|max:20',
            'mensagem'=>'required|min:5|max:255'
        ];
    }
}
