<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
    ];
    protected $appends = [
        'name'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    public function getNameAttribute($value)
    {
        return $this->user ? $this->user->name: "deleted";
    }

}
