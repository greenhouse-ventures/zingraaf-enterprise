<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class newTask extends FormRequest
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

            'entitle'=> 'required|max:100',
            'description'=>'max:255',
            'division'=>'required|exists:divisions,iddiv',


        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=> false,
            'status_code'=> 422,
            'error' => true,
            'message' => 'Validation error',
            'errorList'=> $validator->errors()
        ]));
    }

    public function messages(){
        return [
            'entitle.required'=> 'Please provide an entitle',
            'division.exists'=> 'Please an existing division'
        ];
    }

}
