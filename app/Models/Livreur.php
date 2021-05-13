<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'agence_id',
        'city',
        'status',
        'prix'
    ];
    protected $hidden = [
        'password',
    ];

    public function colis()
    {
        return $this->hasMany(Colis::class);
    }
    public function colis_livre()
    {
        return $this->colis->where('status', 'livré')->count();
    }
    public function payed()
    {
        return $this->colis->where('status', 'livré')->count() * $this->prix;
    }
    public function total()
    {
        return $this->colis->whereNotIn('status', ['return', 'livré'])->sum('montant');
    }
    public function totalNet()
    {
        return $this->colis->whereNotIn('status', ['return', 'livré'])->sum('montant') - $this->payed();
    }
    public function colis_encore()
    {
        return $this->colis->whereNotIn('status', ['return', 'livré'])->count();
    }
    public function colis_return()
    {
        return $this->colis->where('status', 'return')->count();
    }
}
