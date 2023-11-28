<?php

namespace App\Http\Requests;

use App\Models\Booking;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BookingRequest extends FormRequest
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
        $data = [
            "client_id" => 'required|exists:clients,id',
            "hotel_id" => 'required|exists:hotels,id',
            "arrival_date" => 'required|date',
            "departure_date" => 'required|date',
            "nights_number" => 'required|numeric',
            "amount" => 'required|numeric',
            "guests" => 'required',
        ];

        if($this->method() === "PUT") {
            $data["status"] = 'required|in:'.implode(",", array_keys(Booking::STATUS));
        }

        return $data;
    }

    public function messages()
    {
        return [
            'client_id.required' => 'El cliente es requerido',
            'hotel_id.required' => 'El hotel es requerido',
            'arrival_date.required' => 'La fecha de llegada es requerida',
            'departure_date.required' => 'La fecha de salida es requerida',
            'departure_date.date' => 'La fecha de salida debe tener formato fecha',
            'nights_number.required' => 'El número de noches es requerido',
            'nights_number.numeric' => 'El número debe ser un número',
            'amount.required' => 'El monto es requerido',
            'amount.numeric' => 'El monto debe ser númerico',
            'guests.required' => 'La data de los huespedes es requerida',
          
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}

