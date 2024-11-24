<?php

namespace App\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|regex:/^\+380\d{9}$/|unique:clients,phone|max:20',
            'city' => 'nullable|string',
            'status' => 'required|in:ordered,not ordered,vip client,'
        ];
    }
}
