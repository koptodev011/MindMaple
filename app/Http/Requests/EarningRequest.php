<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EarningRequest extends FormRequest
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
            'earningName' => 'required|string|max:255',
            'earningAmount' => 'required|numeric|min:0',
            'earningMonth' => 'required|integer|between:1,12', // Validate month
        ];
    }

    public function messages()
    {
        return [
            'earningName.required' => 'The area of earnings is required.',
            'earningAmount.required' => 'The amount is required.',
            'earningMonth.required' => 'The month is required.',
            'earningMonth.between' => 'Please select a valid month.',
        ];
    }
}
