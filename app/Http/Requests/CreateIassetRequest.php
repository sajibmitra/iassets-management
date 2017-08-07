<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIassetRequest extends FormRequest
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
            'serial_id' => 'required|min:5|max:50',
            'product_id' => 'required|min:5|max:50',
            'model'=> 'required|min:3|max:50',
            'purchase_at' => 'required|date',
            'entry_at' => 'required|date',
            'warranty' => 'required',
            'unique_office_id' => 'required',
            'type' => 'required',
            'brand' => 'required',
            'status' => 'required',
            'iuser_id' => 'required',
            'ivendor_id' => 'required',
        ];
    }
}
