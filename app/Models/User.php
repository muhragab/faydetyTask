<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'first_name', 'last_name', 'phone_number', 'avatar', 'password',
        'country_code', 'gender', 'birthday', 'auth_token', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'auth_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'phone_number' => 'string',
        'avatar' => 'string',
        'email' => 'string',
        'gender' => 'string',
        'country_code' => 'string',
        'birthday' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'phone_number' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/|unique:users,phone_number',
        'avatar' => 'required | mimes:jpeg,png,jpg',
        'email' => 'nullable | email | unique:users,email',
        'password' => 'required | string | ',
        'gender' => 'required | in:male,female',
        'country_code' => 'required | string',
        'birthday' => 'required|string |date_format:Y-m-d',
    ];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
