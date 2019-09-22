<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProveedorRequest extends FormRequest
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
            'razon_social'  => 'required|max:30',
            'ciudad'        => 'exists:ciudades,id',
            'telefono'      => 'required|max:30',
            'direccion'     => 'required|max:30',
            'gerente'       => 'required|max:50',
            'edad_rc'       => 'required|max:20',
            'email'         => 'required|max:50'
        ];
    }
}
