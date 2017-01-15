<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IassetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //anyone can create asset
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'asset_id'   =>  'required|min:3',
            'serial_id'  =>  'required',
            'product_id' =>  'required',
            'type'       =>  'required',
            'brand'      =>  'required',
            'model'      =>  'required',
            'purchase_at'=>  'required|date',
            'entry_at'   =>  'required|date',
            'warranty'   =>  'required',
            'status'     =>  'required',
            'section'    =>  'required',
            'vendor_id'  =>  'required',
            'user_id'    =>  'required'        ];
    }
}
