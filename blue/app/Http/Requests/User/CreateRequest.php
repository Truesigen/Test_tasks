<?php

namespace App\Http\Requests\User;

use App\DTOs\UserDTO;
use App\Enums\UserStatus;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'phone' => 'nullable|string|size:11',
            'role_id' => 'required|integer|in:1,2,3',
            'avatar' => 'nullable|image',
        ];
    }

    public function toDTO(): UserDTO
    {
        $data = $this->validated();
        $data['status'] = UserStatus::ACTIVE;

        return UserDTO::fromArray($data);
    }
}
