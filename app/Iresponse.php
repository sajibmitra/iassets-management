<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iresponse extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'iuser_dtl', 'iasset_dtl', 'report_via', 'problem_dtl', 'requested_at', 'finished_at', 'problem_status', 'respond_by', 'action_taken', 'remarks'
  ];

  public function iassets(){
      return $this->belongsToMany('App\Iasset');
  }

  public function iuser(){
      return $this->belongsTo('App\Iuser');
  }
}
