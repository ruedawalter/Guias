<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFpagoRequest extends FormRequest
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
            //
            'nombre' => 'required',
            'nombre' => 'max:60',
            'nombre' => 'unique:fpagos'
        ];
    }

     public function message() {

        return [

            'nombre.required'   => 'El nombre del banco es requerido',
            'nombre.unique'     => 'El nombre del banco ya se encuentra registrado'

        ];

    }
}

