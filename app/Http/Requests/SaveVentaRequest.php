<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVentaRequest extends FormRequest
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
            'productos'             => 'array|min:1',
            'productos.*.id'        => 'exists:productos,id',
            'productos.*.cantidad'  => 'numeric|min:0',
            'cliente'               => 'exists:clientes,id'
        ];

    }
}
