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
        // Esto aquì SOLO debe ser true cuando el usuario actual tiene
        // asignados los permisos para crear (o editar)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // esto debe SIEMPRE coincidir con la longitud máxima en base de datos
        return [
            'tipo_de_documento'    => 'nullable|exists:tipos_de_documento,id',
            'documento'            => 'nullable|min:7|max:20',
            'nombre'               => 'required|min:3|max:30',
            'apellidos'            => 'required|min:3|max:30',
            'direccion'            => 'required|min:5|max:30',
            'barrio'               => 'required|min:3|max:30',
            'telefono'             => 'required|min:7|max:30',
            'email'                => 'nullable|email|max:50',
            'fecha_de_nacimiento'  => 'required|date'
        ];
    }
}
