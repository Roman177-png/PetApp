<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'photoUrls' => 'required|array|min:1',
            'photoUrls.*' => 'url',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The pet name is required.',
            'status.required' => 'The pet status is required.',
            'photoUrls.required' => 'At least one photo URL is required.',
            'photoUrls.*.url' => 'Each photo URL must be a valid URL.',
            'tags.array' => 'Tags must be an array.',
            'category_id.integer' => 'Category ID must be an integer.',
        ];
    }
}
