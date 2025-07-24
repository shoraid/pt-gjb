<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $name
 * @property-read string $email
 * @property-read string|null $phone_number
 * @property-read string $password
 * @property-read string $password_confirmation
 */
class RegisterRequest extends FormRequest
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
            'name' => 'required|max:250',
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->withoutTrashed()],
            'phone_number' => 'nullable|max:500',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('app.users.name'),
            'email' => __('app.users.email'),
            'phone_number' => __('app.users.phone_number'),
            'password' => __('app.users.password'),
            'password_confirmation' => __('app.users.password_confirmation'),
        ];
    }
}
