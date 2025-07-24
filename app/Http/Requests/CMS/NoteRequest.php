<?php

namespace App\Http\Requests\CMS;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoteRequest extends FormRequest
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
            'title' => 'required|max:250',
            'content' => 'required',
            'user_ids' => 'nullable|array',
            'user_ids.*' => Rule::exists(User::class, 'id'),
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('app.notes.title'),
            'content' => __('app.notes.content'),
            'user_ids' => __('app.notes.users'),
            'user_ids.*' => __('app.notes.users'),
        ];
    }
}
