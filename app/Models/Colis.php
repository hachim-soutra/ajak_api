<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ville_depart',
        'ville_arrive',
        'status',
        'phone',
        'produit',
        'user_id',
        'agence_id',
        'client_id',
        'date_livraison',
        'date_arrive',
        'description',
        'adresse',
        'montant',
        'token',
        'livreur_id'
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    public function client()
    {
        return $this->belongsTo(User::class,"client_id")->where("userable_type",Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}
