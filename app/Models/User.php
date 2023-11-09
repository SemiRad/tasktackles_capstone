<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
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
        'street',
        'province',
        'hnum',
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
