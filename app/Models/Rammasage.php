<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rammasage extends Model
{
    use HasFactory;

    protected $fillable = [
        'colis_id',
        'user_id',
        'agence_id',
        'quantity',
        'price'
    ];

    public function colis()
    {
        return $this->belongsTo(Colis::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
