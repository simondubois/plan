<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
        return [
            'project_id' => [
                'numeric',
                'required',
                Rule::exists('projects', 'id'),
            ],
            'parent_id' => [
                'numeric',
                'nullable',
                Rule::exists('tasks', 'id'),
            ],
            'name' => [
                'string',
                'required',
                'max:255',
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
        ];
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        return collect(parent::validated())
            ->put('start', $this->date)
            ->put('end', $this->date)
            ->forget('date')
            ->toArray();
    }
}
