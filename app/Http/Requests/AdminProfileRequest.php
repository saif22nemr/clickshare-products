<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProfileRequest extends FormRequest
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
        $employeeId = request('manager_id');
        return [
            'first_name' => 'required|string|min:1|max:190',
            'last_name' => 'required|string|min:1|max:190',
            'email' => [
                'required',
                'string',
                'email',
                'unique:users,email,' . $employeeId
            ],
            'password' => 'nullable|min:6|string',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,svg,gif',
        ];
    }
}
