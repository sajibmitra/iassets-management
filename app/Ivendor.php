<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ivendor extends Model
{

    protected $fillable=[
        'name', 'address', 'mobile', 'phone', 'email'
    ];

    /** An shop could have multiple iassets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function iassets(){
        return $this->hasMany('App\Iasset');
    }
}
