<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function service()
    {
        return $this->hasMany(Service::class);
    }
    protected $table = 'user';
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'birthday',
        'gender',
        'contact',
        'address',
        'city',
        'email_address',
        'usertype',
        'profile_picture',
        'service_name',
        'password',
        'account_status',
        'id_img'
    ];
}
