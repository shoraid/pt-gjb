<?php

namespace App\Http\Requests\CMS;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $name
 * @property-read string $email
 * @property-read string|null $phone_number
 * @property-read string $password
 * @property-read string $password_confirmation
 * @property-read array|null $role_ids
 */
class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:250',
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->withoutTrashed()],
            'phone_number' => 'nullable|max:500',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'image' => 'nullable|mimes:png,jpg|max:2048',
            'role_ids' => 'nullable|array',
            'role_ids.*' => Rule::exists(Role::class, 'id'),
        ];

        if (!$this->isMethod('POST')) {
            unset(
                $rules['email'],
                $rules['password'],
                $rules['password_confirmation'],
            );
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => __('app.users.name'),
            'email' => __('app.users.email'),
            'phone_number' => __('app.users.phone_number'),
            'password' => __('app.users.password'),
            'password_confirmation' => __('app.users.password_confirmation'),
            'image' => __('app.users.image'),
            'role_ids' => __('app.users.roles'),
            'role_ids.*' => __('app.users.roles'),
        ];
    }
}
