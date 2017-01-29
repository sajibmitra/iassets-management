<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iworkstation extends Model
{
    protected $fillable =[
        'iworkstation_id', 'net_switch_id', 'net_switch_port', 'net_dhcp_ip', 'net_mac_id', 'net_login_status', 'net_faceplate_id', 'os_detail_info', 'lnk_printer_id', 'sys_product_id', 'user_id'
    ];

    /** Single Workstation used by multiple users
     *
     */
    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps()->orderBy('pivot_updated_at');
    }
}