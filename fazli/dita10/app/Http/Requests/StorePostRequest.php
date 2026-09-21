<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_published' => $this->boolean('is_published'),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:80'],
            'excerpt' => ['required', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'author' => ['required', 'string', 'max:120'],
            'image_url' => ['required', 'url:http,https', 'max:2048'],
            'read_time' => ['required', 'integer', 'min:1', 'max:60'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ];
    }
}
