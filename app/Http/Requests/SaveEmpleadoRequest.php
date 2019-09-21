<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEmpleadoRequest extends FormRequest
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
            'tipo_de_documento_id' => 'exists:tipos_de_documento,id',
            'documento'            => 'required|numeric',
            'nombres'              => 'required|min:3|max:30',
            'apellidos'            => 'required|min:3|max:30',
            'direccion'            => 'required|min:5|max:100',
            'barrio'               => 'required|min:3|max:50',
            'telefono'             => 'required|numeric',
            'ocupacion'            => 'required|min:3|max:50'
        ];
    }
}
