<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'nullable|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function validated($key = null, $default = null): mixed
    {
        $data = parent::validated();
        $data['password'] = Hash::make($data['password']);
        return $data;
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
            'phone.numeric' => 'Phone number must be numeric.',
            'phone.min' => 'Phone number must be at least 11 characters.',
            'phone.regex' => 'Phone number must be numeric.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and Confirm Password must match.',
        ];
    }
}
