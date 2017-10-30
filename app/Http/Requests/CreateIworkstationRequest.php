<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIworkstationRequest extends FormRequest
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
            'net_switch_id' => 'required',
            'net_switch_port' => 'required',
            //'net_dhcp_ip'=> 'required|min:7|max:15',
            //'net_mac_id' => 'required|size:17',
            'net_login_status' => 'required',
            'net_faceplate_id' => 'required|size:5',
            'os_detail_info' => 'required',
            'os_product_key' => 'required',
            'os_host_id' => 'required',
            'iuser_id' => 'required',
        ];
    }
}
