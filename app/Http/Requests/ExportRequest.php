<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'data' => 'required|array',
            'column_names' => 'required|array',
            'column_names.*' => 'nullable|string', // Allows null or non-empty string
            'column_names' => function ($attribute, $value, $fail) {
                // Check if at least one non-empty value is selected
                if (count(array_filter($value)) === 0) {
                    $fail('At least one column must be selected.');
                }
            },
        ];
    }
}
