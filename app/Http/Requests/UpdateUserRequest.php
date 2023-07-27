<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUserRequest extends FormRequest
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
        //dd($this->route('user')->id);
        $rules =[
            'name'=> 'required',
            'email'=>['required', Rule::unique('users')->ignore($this->route('user')->id)]
        ];

        if ($this->filled('password')){
            $rules['password']= ['confirmed','min:6'];
        }
        return $rules;
    }
}
