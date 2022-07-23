<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotel extends FormRequest
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
            'name' => 'required|unique:hotels|max:255',
            'street' => 'required|max:255',
            'postal_code' => 'required|max:50',
            'city' => 'required|max:100',
            'country' => 'required|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|max:50'
        ];
    }
}
