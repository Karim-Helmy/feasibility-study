<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $fillable = ["logo","title","description","start_date","status","end_date","hours_no","days_no","subscriber_id"];

  /**
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function level()
  {
      return $this->hasMany('App\Level')->orderBy('ordering');
  }

  public function courseUser()
  {
      return $this->hasMany('App\CourseUser');
  }

  /**
  * @return \Illuminate\Database\Eloquent\Relations\belongsTo
  */
  public function category()
  {
      return $this->belongsTo('App\Category','category_id');
  }

}
