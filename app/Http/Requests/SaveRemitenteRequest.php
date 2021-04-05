<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRemitenteRequest extends FormRequest
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
            'direccion' => 'required',
            'distrito_id' => 'required',
            'telefono' => 'required', 
            'cel' => 'required',
            'email' => 'required'
        ];
    }

     public function message() {

        return [

            'nombre.required' => 'El nombre del cliente es requerido',
            'direccion.required' => 'La direccion del cliente es requerida',
            'distrito_id.required' => 'El distrito es requerido, seleccione uno de la lista',
            'cel.required' => 'El Celular del cliente es requerido',
            'telefono.required' => 'El Celular del cliente es requerido',
            'email.required' => 'el correo electrónico del cliente es requerida'


        ];

    }
}
