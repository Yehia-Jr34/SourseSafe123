<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
    {
        return $this->hasMany(Member::class);
    }

    protected $fillable = [
        'name',
        'admin'
    ];

    public function file()
    {
        return $this->hasMany(File::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
