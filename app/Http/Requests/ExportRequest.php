<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExportRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'full_name' => 'required_without_all:phone_number,email_address',
             'phone_number' => 'required_without_all:full_name,email_address',
            'email_address' => 'required_without_all:full_name,phone_number',
        ];
    }
}
