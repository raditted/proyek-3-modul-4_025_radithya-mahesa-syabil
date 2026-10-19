<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangeRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => ['required', 'string', Rule::in(['customer', 'staff'])],
        ];
    }
}
