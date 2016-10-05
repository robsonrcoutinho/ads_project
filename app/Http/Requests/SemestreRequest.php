<?php

namespace adsproject\Http\Requests;

class SemestreRequest extends Request
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
            'codigo' => 'required|size:6',
            'inicio' => 'required|date',
            'termino' => 'required|date|after:inicio',
            'disciplinas' => 'required'
        ];
    }
}
