<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class SaveDistritoRequest extends FormRequest
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
            
                'distrito' => 'required|max:100|unique:distritos'
        ];
    }

    public function message() {

        return [

            'distrito.required' => 'El distrito necesita un nombre',
            // 'url.required' => 'La URL necesita una dirección',
            // 'description.required' => 'La descripción para el proyecto es necesaria'


        ];

    }
}
