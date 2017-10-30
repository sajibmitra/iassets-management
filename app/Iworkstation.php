<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iworkstation extends Model
{
    protected $fillable =[
        'iworkstation_id', 'net_switch_id', 'net_switch_port', 'net_dhcp_ip', 'net_mac_id', 'net_login_status', 'net_faceplate_id', 'os_detail_info', 'lnk_printer_id', 'os_product_key', 'os_host_id', 'iuser_id'
    ];

    /** Single Workstation used by multiple iusers
     *
     */
    public function setAssetsGroupIdAttribute(){
            $this->attributes['assets_group_id']=$this->attributes['assets_group_id']+1;
    }
    public function iusers(){
        return $this->belongsToMany('App\Iuser')->withTimestamps()->orderBy('pivot_updated_at');
    }
    public function iassets(){
        return $this->belongsToMany('App\Iasset')->withTimestamps();
    }
}
