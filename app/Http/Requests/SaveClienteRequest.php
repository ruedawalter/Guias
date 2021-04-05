<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveClienteRequest extends FormRequest
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
            'nombre' => 'required|max:60',
            'direccion' => 'required|max:100',
            'distrito_id' => 'required',
            'telefono'=> 'required|max:10',
            'cel' => 'required|max:9',
            // 'email' => 'required|max:100'
        ];
    }

     public function message() {

        return [

            'nombre.required' => 'El nombre del cliente es requerido',
            'direccion.required' => 'La direccion del cliente es requerida',
            'distrito_id.required' => 'El distrito es requerido, seleccione uno de la lista',
            'telefono.required' => 'El Celular del cliente es requerido',
            'cel.required' => 'El Celular del cliente es requerido',
            // 'email.required' => 'el correo electrónico del cliente es requerida',


            // 'nombre.max' => 'El nombre del cliente no puede exceder 60 caracteres',
            // 'direccion.max' => 'La direccion del cliente no puede exceder 100 caracteres',

            // 'telefono.max' => 'El Celular del cliente no puede exceder 10 caracteres',
            // 'cel.max' => 'El Celular del cliente no puede exceder 9 caracteres',
            // 'email.max' => 'el correo electrónico del cliente no puede exceder 60 caracteres'



            // 'cel.unique' => 'El Celular del cliente ya se encuentra en uso',
            // 'email.required' => 'el correo electrónico del cliente ya se encuentra en uso'


        ];

    }
}
