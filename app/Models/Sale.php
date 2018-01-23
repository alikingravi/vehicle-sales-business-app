<?php
/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 25/12/2017
 * Time: 22:47
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle');
    }
}
