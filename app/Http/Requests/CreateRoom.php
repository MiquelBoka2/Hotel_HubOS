<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoom extends FormRequest
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
            'hotel_id' =>'required|numeric|min:1',
            'name' => 'required|unique|max:255',
            'floor' => 'required|numeric|between:1,10',
            'capacity' => 'required|numeric|between:1,6'
        ];
    }
}
