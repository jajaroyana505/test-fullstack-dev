<?php

namespace App\Http\Requests;

use App\Models\People;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeopleUpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'phone' => ['required', 'string'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('people', 'email')->ignore($this->people->id),
            ],
            'street' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'country' => ['required', 'string'],
            'postal_code' => ['required', 'numeric'],
        ];
    }
}
