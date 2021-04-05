<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEstadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            
                'nombre' => 'required|max:60|unique:estados'
        ];
    }

    public function message() {

        return [

            'nombre.required' => 'Se necesita un nombre',
            // 'url.required' => 'La URL necesita una dirección',
            // 'description.required' => 'La descripción para el proyecto es necesaria'


        ];

    }
}
