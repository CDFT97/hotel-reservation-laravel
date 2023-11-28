<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class HotelRequest extends FormRequest
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
            "name" => "required|string",
            "address" => "required|string",
            "country" => "required|string",
            "state" => "required|string",
            "city" => "required|string",
            "nit" => "required|string",
            "phone" => "string",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un string',
            'address.required' => 'La dirección es requerida',
            'address.string' => 'La dirección debe ser un string',
            'country.required' => 'El pais es requerido',
            'country.string' => 'El pais debe ser un string',
            'state.required' => 'El estado/Departamento es requerido',
            'state.string' => 'El estado/Departamento debe ser un string',
            'city.required' => 'La ciudad es requerida',
            'city.string' => 'La ciudad debe ser un string',
            'nit.required' => 'El NIT es requerido',
            'nit.string' => 'El NIT debe ser un string',
            'phone.string' => 'El telefono debe ser un string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
