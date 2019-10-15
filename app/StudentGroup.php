<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
  protected $fillable = ["title","subscriber_id"];

  /**
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function groupUser()
  {
      return $this->hasMany('App\GroupUser','student_group_id');
  }
}
