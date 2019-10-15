<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
  protected $fillable = ["title","start_date","end_date","class_no","link","user_id","course_id","subscriber_id"];

  /**
  * @return \Illuminate\Database\Eloquent\Relations\belongsTo
  */
  public function course()
  {
      return $this->belongsTo('App\Course','course_id');
  }
}
