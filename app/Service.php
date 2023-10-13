<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'service';
    protected $fillable = [
        'service_list_name',
        'user_id',
        'description',
        'price',
        'photo',
        'category',
    ];
}
