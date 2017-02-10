<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use Carbon\Carbon;
class Iasset extends Model
{
    protected $fillable =[
        'iasset_id','unique_office_id','serial_id', 'product_id','type','brand','model','purchase_at', 'entry_at','warranty','status', 'iuser_id','ivendor_id'
    ];

    public function setPurchaseAtAttribute($date){
        $this->attributes['purchase_at']= Carbon::createFromFormat('Y-m-d', $date);
    }

    public function setEntryAtAttribute($date){
        $this->attributes['entry_at']= Carbon::createFromFormat('Y-m-d', $date);
    }

    /*    public function scopePublished($query){
            $query->where('entry_at','<=',Carbon::now());
        }

        public function scopeUnpublished($query){
            $query->where('entry_at','>',Carbon::now());
        }

        public function setEntryAtAttribute($date){
            $this->attributes['entry_at']= Carbon::parse($date);
        }
    */
    /** An asset used by multiple iusers
     *
     */
    public function iusers(){
        return $this->belongsToMany('App\Iuser')->withTimestamps()->orderBy('pivot_updated_at');
    }
    /**An asset brought from only one shop
     * @return mixed
     */
    //An asset belongs to only one vendor
    public function ivendor(){
        return $this->belongsTo('App\Ivendor');
    }

    public function iworkstations(){
        return $this->belongsToMany('App\Iworkstation')->withTimestamps()->orderBy('pivot_updated_at');;
    }
}