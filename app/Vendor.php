<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'vendor_id', 'name', 'address', 'mobile', 'phone', 'email'
        ];
    //A vendor can have many assets
    public function iassets(){
    	return $this->hasMany('App\Iasset');
    }
}
