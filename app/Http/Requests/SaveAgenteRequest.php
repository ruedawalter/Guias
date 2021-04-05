<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveAgenteRequest extends FormRequest
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
            'nombres' => 'required|max:60',
            'cel' => 'required|max:9',
            'email' => 'required|max:100'
        ];
    }

     public function message() {

        return [

            'nombres.required' => 'Los Nombres del agente son requeridos',
            'cel.required' => 'El Telefono movil es requerido',
            'email.required' => 'El correo electóronico es requerido'

            // 'nombres.max' => 'Los Nombres del agente solo puede tener 60 digitos maximo',
            // 'cel.max' => 'El Telefono movil solo puede tener 9 digitos maximo',
            // 'email.max' => 'El correo electórónico solo puede tener 100 digitos maximo'

            // 'nombres.unique' => 'Los Nombres del agente son requeridos',
            // 'cel.unique' => 'El Telefono movil es requerido',
            // 'email.unique' => 'El correo elect´ronico es requerido'



        ];

    }
}

