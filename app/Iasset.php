<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Iasset extends Model
{
	protected $fillable	=	['asset_id','serial_id','product_id','type','brand','model','purchase_at','entry_at','warranty','status','section','vendor_id','user_id'];

	public function scopePurchased($query){
		$query->where('purchase_at','<=',Carbon::now());
	}

	public function scopeNotpurchased($query){
		$query->where('purchase_at','>',Carbon::now());
	}

	public function setPurchaseAtAttribute($date){
		$this->attributes['purchase_at']= Carbon::createFromFormat('Y-m-d', $date);
	}

	public function setEntryAtAttribute($date){
		$this->attributes['entry_at']= Carbon::createFromFormat('Y-m-d', $date);
	}
	//An asset can be used by many user
	public function users(){
		return $this->belongsToMany('App\User'); 
	}
	//An asset belongs to only one vendor
	public function vendor(){
		return $this->belongsTo('App\Vendor'); 
	}
}
