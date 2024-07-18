<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'firstname' => 'required|string|min:3|max:255',
            'lastname' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:50|unique:users,email',
            'address-line-1' => 'required|string|min:3|max:150',
            'address-line-2' => 'string|min:3|max:150',
            'postcode' => 'required|string|min:3|max:10',
            'city' => 'required|string|min:3|max:50',
            'mobile-phone' => 'required|string|min:3|max:12|unique:users,mobile_phone',
        ];
    }
}
