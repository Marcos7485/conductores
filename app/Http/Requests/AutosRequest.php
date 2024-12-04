<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comprobante' => 'required|string|max:255',
            'conductores' => 'required|array|min:1',
            'conductores.*' => 'string|max:255', 
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'modelo_2' => 'required|string|max:255',
            'patente' => 'required|string|max:255',
            'poliza' => 'required|string|max:255',
        ];
    }
}
