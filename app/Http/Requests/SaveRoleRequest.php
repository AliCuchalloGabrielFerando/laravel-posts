<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRoleRequest extends FormRequest
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
        $rules = [
            'display_name'=> 'required',
            'guard_name'=>'required'
        ];
        if ($this->method() !== 'POST')
        {
        $rules['name'] = 'required|unique:roles';
            }
        return $rules;
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    
    public function messages(): array
    {
         return [
            'name.required'=>'El Identificador del role es obligatorio',
            'name.unique'=>'El Identificador para el role ya ha sido registrado',
            'display_name'=>'El Nombre del role es obligatorio'
         ];
    }
}

   /*   $data = Validator::make($request->all(),[
            'display_name'=>'required',
            'guard_name'=>'required'
        ],
        [
            'display_name.required' => 'El campo nombre es obligatorio'
        ])->validate();
       $data = $request->validate([
            'name'=>'required|unique:roles,name,' . $role->id,
            'display_name'=>'required',
            'guard_name'=>'required'
        ],[
            'display_name.required' => 'El campo Mombre es obligatorio'
        ]);*/