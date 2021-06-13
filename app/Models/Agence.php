<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'adresse',
        'phone',
        'email',
        'status',
        'city'
    ];

    public function colis()
    {
        return $this->hasMany(Colis::class);
    }
    public function users()
    {
        return $this->hasMany(User::class)->where("userable_type",Admin::class);
    }
    public function clients()
    {
        return $this->hasMany(User::class)->where("userable_type",Client::class);
    }
}
