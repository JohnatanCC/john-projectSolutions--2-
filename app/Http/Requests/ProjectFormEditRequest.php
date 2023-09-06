<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectFormEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'client_name' => [
                'required',
                'max:255',
                'min:3'
            ],
            'title' => [
                'required',
                'max:255',
                'min:3'
            ],
            'description' => [
                'required',
                'min:3'

            ],
            'observation' => [],
            'project_link' => [],
            'pdf_file' => [
                'required',
                'mimes:pdf',
                'max:2048'
            ],
            'photo_file' => [
                'required',
                'array',
                'max:6', 
                function ($attribute, $value, $fail) {
                    foreach ($value as $file) {
                        $formatsAllowed = ['jpeg', 'jpg', 'png', 'gif', 'svg'];

                     
                        if (!in_array(strtolower($file->getClientOriginalExtension()), $formatsAllowed)) {
                            $fail("O campo $attribute deve ser um arquivo dos tipos: " . implode(', ', $formatsAllowed));
                        }
                    }
                },
            ],
        ];
        return $rules;
    }
}
