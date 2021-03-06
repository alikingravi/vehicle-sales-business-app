<?php
/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 30/12/2017
 * Time: 14:35
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token'
    ];

    public function vehicles()
    {
        return $this->hasMany('App\Models\Vehicle');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Account');
    }
}