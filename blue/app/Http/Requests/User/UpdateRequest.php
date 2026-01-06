<?php

namespace App\Http\Requests\User;

use App\DTOs\UserDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|size:11',
            'role_id' => 'nullable|integer|in:1,2,3',
            'avatar' => 'nullable|image',
        ];
    }

    public function toDTO()
    {
        return UserDTO::fromArray($this->validated());
    }
}
