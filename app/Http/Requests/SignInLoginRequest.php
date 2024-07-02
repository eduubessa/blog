<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
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
            'username' => 'required|string|min:4|max:100',
            'password' => 'required|string|min:4|max:100',
            'remember' => 'boolean|in:1,0|default:0',
        ];
    }
}
