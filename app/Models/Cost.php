<?php
/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 30/12/2017
 * Time: 14:33
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $guarded = ['id'];

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle');
    }
}
