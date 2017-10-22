<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Requests;
class Iuser extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'department', 'section', 'designation', 'contact_no', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** An user has many Assets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function iassets(){
        //return $this->belongsToMany('App\Iasset')->withTimestamps()->orderBy('pivot_updated_at','dsce')->groupBy('pivot_iasset_id');
        return $this->belongsToMany('App\Iasset')->withTimestamps()->orderBy('pivot_updated_at','dsce');
    }
    public function iworkstations(){
        return $this->belongsToMany('App\Iworkstation')->withTimestamps();
    }
    public function iresponses(){
        return $this->belongsToMany('App\Iresponse');
    }
}
