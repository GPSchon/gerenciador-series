<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
        if ($this->isMethod('patch')) {
            // Atualização parcial: só valida se o campo vier
            return [
                'name'    => ['sometimes', 'string', 'min:3'],
                'season'  => ['sometimes', 'integer', 'min:1'],
                'episode' => ['sometimes', 'integer', 'min:1'],
                'cover'   => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            ];
        }

        return [
            'name'    => ['required', 'string', 'min:3'],
            'season'  => ['required', 'integer', 'min:1'],
            'episode' => ['required', 'integer', 'min:1'],
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];
    }
}
