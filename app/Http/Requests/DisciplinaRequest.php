<?php namespace adsproject\Http\Requests;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/03/2016
 * Time: 09:06
 */

class DisciplinaRequest extends Request
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
            'codigo'=>'required|size:6',
            'nome'=>'required|min:5',
            'carga_horaria'=>'required|integer',
            'ementa'=>'url'
        ];
    }
}
