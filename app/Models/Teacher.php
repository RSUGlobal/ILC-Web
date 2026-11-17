<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    public $incrementing = false;

    protected $attributes = ['id' => 1];

    protected $fillable = ['email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
