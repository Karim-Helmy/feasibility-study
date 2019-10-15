<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','phone','email','address','school','logo','title','description','photos','package_id','status','payment'];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function package()
    {
        return $this->belongsTo('App\Package','package_id');
    }

}
