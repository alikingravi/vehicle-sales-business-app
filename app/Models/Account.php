<?php
/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 30/12/2017
 * Time: 14:34
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}