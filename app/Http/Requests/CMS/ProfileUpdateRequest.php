<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:250',
            'phone_number' => 'nullable|max:500',
            'image' => 'nullable|mimes:png,jpg|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('app.profile.name'),
            'phone_number' => __('app.profile.phone_number'),
            'image' => __('app.profile.image'),
        ];
    }
}
