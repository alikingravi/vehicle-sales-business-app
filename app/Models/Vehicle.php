<?php
/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 25/12/2017
 * Time: 22:46
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function cost()
    {
        return $this->hasOne('App\Models\Cost');
    }

    public function sale()
    {
        return $this->hasOne('App\Models\Sale');
    }
}
