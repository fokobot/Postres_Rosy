<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVentaRequest extends SaveClienteRequest
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
        return array_merge(parent::rules(), [
            'productos'             => 'array|min:1',
            'productos.*.id'        => 'exists:productos,id',
            'productos.*.cantidad'  => 'numeric|min:0',
        ]);

    }
}
