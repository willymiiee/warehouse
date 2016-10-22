<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRule extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'   => 'required|integer',
            'item_id'   => 'required|integer'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_id'   => 'User',
            'item_id'   => 'Item'
        ];
    }

    public function response(array $errors)
    {
        return response()->json([
            'errors'  => $errors
        ], 422);
    }
}
