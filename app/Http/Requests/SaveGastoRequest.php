<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveGastoRequest extends FormRequest
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
          'descripcion'        => 'required|min:3|max:35',
          'valor'              => 'required|numeric',
          'estado'             => 'required',
          'fecha'              => 'required|date'
        ];
    }
}
