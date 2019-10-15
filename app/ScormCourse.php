<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScormCourse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['scorm_id','level_id','subscriber_id'];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function scorm()
    {
        return $this->belongsTo('App\Scorm','scorm_id');
    }

    public function level()
    {
        return $this->belongsTo('App\Level','level_id');
    }
}
