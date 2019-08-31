<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductoRequest extends FormRequest
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
          'nombre'            => 'required|min:3|max:35',
          'valordetal'        => 'required|numeric',
          'valormayor'        => 'required|numeric',
          'minimopormayor'    => 'required|numeric',
        ];
    }
}
