<?php

namespace App\Http\Requests\CMS;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string $name
 * @property-read string|null $description
 * @property-read array|null $permission_ids
 */
class RoleRequest extends FormRequest
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
            'description' => 'nullable|max:500',
            'permission_ids' => 'nullable|array',
            'permission_ids.*' => Rule::exists(Permission::class, 'id'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('app.roles.name'),
            'description' => __('app.roles.description'),
            'permission_ids.*' => __('app.roles.permissions'),
        ];
    }
}
