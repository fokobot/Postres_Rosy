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
            'persona.tipo_de_documento'   => 'nullable|exists:tipos_de_documento,id',
            'persona.documento'           => 'nullable|required|min:6|max:20',
            'persona.nombre'              => 'required|min:3|max:30',
            'persona.apellidos'           => 'required|min:3|max:30',
            'persona.direccion'           => 'required|min:5|max:30',
            'persona.ciudad'              => 'nullable|exists:ciudades,id',
            'persona.barrio'              => 'required|min:3|max:30',
            'persona.telefono'            => 'nullable|min:3|max:30',
            'persona.celular'             => 'nullable|min:3|max:30',
            'persona.fecha_de_nacimiento' => 'nullable|date',
            'email'                       => 'nullable|email|max:50',
            'estrato_social'              => 'nullable|min:0|max:6',
        ];
    }
}
