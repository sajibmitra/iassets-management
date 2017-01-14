<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iasset extends Model
{
	protected $fillable	=	['asset_id','serial_id','product_id','type','brand','model','purchase_at','entry_at','warranty','status','section','vendor_id','user_id'];
}
