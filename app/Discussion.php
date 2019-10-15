<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
  protected $fillable = ["title","user_id","course_id","subscriber_id"];

  /**
  * @return \Illuminate\Database\Eloquent\Relations\belongsTo
  */
  public function course()
  {
      return $this->belongsTo('App\Course','course_id');
  }
}
