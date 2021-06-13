<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Password;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'agence_id',
        'role_id',
    ];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function colis()
    {
        return $this->hasMany(Colis::class,'user_id');
    }
    public function collaborators()
    {
        return Admin::where('role_id', 1)->get();
    }
}
