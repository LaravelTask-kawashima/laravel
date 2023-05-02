<?php

namespace App\Http\Requests;

use App\Rules\AlphaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupStoreRequest extends FormRequest
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
            "name" => ["required" , "string" , "min:5"],
            "email" => ["required" , "email:filter", Rule::unique("users")],
            "password" => ["required", "string" , "min:10" , new AlphaRule() ]
        ];
    }
}
