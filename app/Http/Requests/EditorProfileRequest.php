<?php

namespace App\Http\Requests;

use App\Editor;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditorProfileRequest extends FormRequest
{
    /**
     * Determine if the Editor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required', 'min:3',
            'email' => 'required', 'email', Rule::unique((new Editor)->getTable())->ignore(auth()->id()),
            'nickname' => 'sometimes', 'min:3',
            'country' => 'required',
            'phone' => 'required|min:3',
            'profilePhoto'=> 'sometimes|image|max:4000'
        ];
    }
}
