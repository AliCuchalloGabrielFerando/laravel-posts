<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return  [
            'title'=>'required',
            'excerpt'=>'required',
            'body'=>'required',
            'published_at'=>'required',
            'category_id'=>'required',
            'tags'=>'required'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    /*
    public function messages(): array
    {
    return [
        'title.required' => 'A title is required',
        'body.required' => 'A message is required',
    ];
    }
    */
    /**
 * Get custom attributes for validator errors.
 *
 * @return array<string, string>
 */
/*
public function attributes(): array
{
    return [
        'email' => 'email address',
    ];
}
*/
    
}
