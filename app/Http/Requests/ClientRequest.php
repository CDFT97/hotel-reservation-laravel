<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ClientRequest extends FormRequest
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
        $rules = [
            "name" => 'required|string',
            "dni" => 'required|string|unique:clients,dni',
        ];
        if($this->isMethod('PUT')) {
            $rules['dni'] = "required|unique:clients,dni,{$this->id}";
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un string',
            'dni.required' => 'El documento de identidad (dni) es requerido',
            'dni.string' => 'El documento de identidad (dni) debe ser un string',
            'dni.unique' => 'Ya existe un cliente con este documento de identidad (dni)',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
