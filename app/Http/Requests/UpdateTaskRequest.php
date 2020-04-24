<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->route('task')->children->isNotEmpty()) {
            return [
                'name' => [
                    'string',
                    'required',
                    'max:255',
                ],
                'parent_id' => [
                    'numeric',
                    'nullable',
                    Rule::exists('tasks', 'id'),
                ],
                'position' => [
                    'numeric',
                    'required',
                    'min:0',
                ],
            ];
        }

        return [
            'name' => [
                'string',
                'required',
                'max:255',
            ],
            'parent_id' => [
                'numeric',
                'nullable',
                Rule::exists('tasks', 'id'),
            ],
            'completion' => [
                'numeric',
                'required',
                'min:0',
                'max:100',
            ],
            'estimated_time' => [
                'numeric',
                'required',
                'min:0',
                'max:16777215',
            ],
            'spent_time' => [
                'numeric',
                'required',
                'min:0',
                'max:16777215',
            ],
            'date' => [
                'date',
                'nullable',
            ],
            'position' => [
                'numeric',
                'required',
                'min:0',
            ],
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        if ($this->route('task')->children->isNotEmpty()) {
            return parent::validated();
        }

        return collect(parent::validated())
            ->put('start', $this->date)
            ->put('end', $this->date)
            ->forget('date')
            ->toArray();
    }
}
