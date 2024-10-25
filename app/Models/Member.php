<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsToMany(Group::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    protected $fillable = [
        'user_id',
        'group_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
