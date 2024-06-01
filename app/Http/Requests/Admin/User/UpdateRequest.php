<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role' => 'required|in:' . implode(',', Role::collection()->toArray()),
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->route('user')->id],
            'phone' => ['nullable', 'string', 'max:15'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'role.required' => 'Role is required.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email must not be greater than 255 characters.',
            'email.unique' => 'Email must be unique.',
            'phone.max' => 'Phone number must not be greater than 15 characters.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and Confirm Password must match.',
        ];
    }



}
