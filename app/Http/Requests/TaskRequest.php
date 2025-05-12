<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $method = $this->route()->getActionMethod();

        return match ($method) {
            'index' => $this->getRules(),
            'store' => $this->storeRules(),
            'update' => $this->updateRules(),
            'show' => $this->showRules(),
            'delete' => $this->deleteRules(),
            default => [],
        };
    }

    protected function getRules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'date_column' => 'nullable|string|in:created_at,updated_at',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            'order_column' => 'nullable|string|in:title,status,created_at',
            'order_type' => 'nullable|in:asc,desc',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }

    protected function storeRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,done,in_progress',
        ];
    }

    protected function updateRules(): array
    {
        return [
            'id' => 'nullable|integer|exists:tasks,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,completed,in_progress',
        ];
    }

    protected function showRules(): array
    {
        return [
            'id' => 'nullable|integer|exists:tasks,id',
        ];
    }

    protected function deleteRules(): array
    {
        return [
            'id' => 'nullable|integer|exists:tasks,id',
        ];
    }
}
