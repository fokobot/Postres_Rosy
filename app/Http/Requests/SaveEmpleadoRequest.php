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
            'persona.tipo_de_documento'   => 'exists:tipos_de_documento,id',
            'persona.documento'           => 'required|min:6|max:20',
            'persona.nombre'              => 'required|min:3|max:30',
            'persona.apellidos'           => 'required|min:3|max:30',
            'persona.direccion'           => 'required|min:5|max:30',
            'persona.ciudad'              => 'nullable|exists:ciudades,id',
            'persona.barrio'              => 'required|min:3|max:30',
            'persona.telefono'            => 'nullable|min:3|max:30',
            'persona.celular'             => 'nullable|min:3|max:30',
            'persona.fecha_de_nacimiento' => 'nullable|date',
            'usuario.email'               => 'required|email|max:50',
            'usuario.password'            => 'required|min:8|confirmed',
            'conyuge'                     => 'nullable|min:3|max:30',
            'estado_civil'                => 'exists:estados_civiles,id',
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'persona.tipo_de_documento'   => 'tipo de documento',
            'persona.documento'           => 'documento',
            'persona.nombre'              => 'nombre',
            'persona.apellidos'           => 'apellidos',
            'persona.telefono'            => 'teléfono',
            'persona.celular'             => 'celular',
            'persona.barrio'              => 'barrio',
            'persona.ciudad'              => 'ciudad',
            'persona.direccion'           => 'dirección',
            'persona.fecha_de_nacimiento' => 'fecha de nacimiento',
            'usuario.email'               => 'email',
            'usuario.password'            => 'contraseña',
            'conyuge'                     => 'cónyuge',
        ];
    }
}
