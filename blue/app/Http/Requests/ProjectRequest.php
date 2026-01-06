<?php

namespace App\Http\Requests;

use App\DTOs\ProjectDTO;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:active,completed,archived',
        ];
    }

    public function toDTO(): ProjectDTO
    {
        $data = $this->validated();
        $data['created_by'] = $this->user()->id;

        return ProjectDTO::fromArray($data);
    }
}
