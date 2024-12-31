<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
    public function rules()
    {
        // get http request method
        $method = $this->method();
        if ($method === 'PUT') {
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
        } else {
            return [
                // some content might not be there, but if it is there, it should be validated
                'name' => ['sometimes', 'required', 'string'],
                'email' => ['sometimes', 'required', 'email'],
                'address' => ['sometimes', 'required', 'string'],
                'postalCode' => ['sometimes', 'required', 'string'],
                'city' => ['sometimes', 'required', 'string'],
                'state' => ['sometimes', 'required', 'string'],
                'type' => ['sometimes', 'required', Rule::in(['individual', 'company'])],

            ];
        }
    }
    protected function prepareForValidation()
    {
        // convert postalCode value from request to postal_code 
        if ($this->postalCode) {
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }
    }
}
