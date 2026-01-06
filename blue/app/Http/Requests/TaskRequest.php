<?php

namespace App\Http\Requests;

use App\DTOs\TaskDTO;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,in_progress,completed',
            'priority' => 'required|string|in:low,medium,high',
            'project_id' => 'required|integer|exists:projects,id',
            'assigned_to' => 'nullable|integer|exists:users,id',
            'due_date' => 'nullable|date',
        ];
    }

    public function toDTO(): TaskDTO
    {
        $data = $this->validated();
        $data['created_by'] = $this->user()->id;

        return TaskDTO::fromArray($data);
    }
}
