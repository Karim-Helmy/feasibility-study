<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scorm extends Model
{
  protected $fillable = ["title","description","scorm","admin_id","category_id"];

  /**
  * @return \Illuminate\Database\Eloquent\Relations\belongsTo
  */
  public function category()
  {
      return $this->belongsTo('App\Category','category_id');
  }
}
