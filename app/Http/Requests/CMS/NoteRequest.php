<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;

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
            'archived' => 'required|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'title' => __('app.notes.title'),
            'content' => __('app.notes.content'),
            'archived' => __('app.notes.archived'),
        ];
    }
}
