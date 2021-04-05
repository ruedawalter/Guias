<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUsuarioRequest extends FormRequest
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
            'name' => 'required',
            'id_rol' => 'required',
            'email' => 'required'
        ];
    }

     public function message() {

        return [

            'name.required' => 'El nombre del usuario es requerido',
            'email.required' => 'El correo electrónico es requerida',
            'id_rol.required' => 'El rol es reuqerido, seleccione uno de la lista'  

        ];

    }
}
