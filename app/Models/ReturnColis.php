<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnColis extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'colis_id',
        'description'
    ];

    public function colis()
    {
        return $this->belongsTo(Colis::class, "colis_id");
    }
}
