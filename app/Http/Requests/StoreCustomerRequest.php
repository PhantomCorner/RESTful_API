<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user !== null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'postalCode' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'type' => ['required', Rule::in(['individual', 'company'])],

        ];
    }

    protected function prepareForValidation()
    {
        // convert postalCode value from postalCode to postal_code
        $this->merge([
            'postal_code' => $this->postalCode
        ]);
    }
}
