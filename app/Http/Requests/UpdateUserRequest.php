<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->id === $this->route('user')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'username' => 'min:3|max:24|string|max:24|unique:users,username,' . Auth::user()->id,
            'description' => 'nullable|string|max:255',
        ];
    }
}
