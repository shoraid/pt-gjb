<?php

namespace App\Http\Requests\CMS;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property-read string|null $parent_id
 * @property-read string $name
 * @property-read string $display_order
 * @property-read string|null $description
 */
class PermissionRequest extends FormRequest
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
            'id' => ['required', Rule::unique(Permission::class, 'id')],
            'parent_id' => ['nullable', Rule::exists(Permission::class, 'id')->whereNull('parent_id')],
            'name' => 'required|max:250',
            'display_order' => 'required|numeric|min:1',
            'description' => 'nullable|max:500',
        ];

        if (!$this->isMethod('POST')) {
            unset($rules['id']);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'id' => __('app.permissions.id'),
            'parent_id' => __('app.permissions.parent'),
            'name' => __('app.permissions.name'),
            'display_order' => __('app.permissions.display_order'),
            'description' => __('app.permissions.description'),
        ];
    }
}
