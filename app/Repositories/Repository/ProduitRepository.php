<?php

namespace App\Repositories\Repository;

use App\Models\Produit;
use App\Repositories\RepositoryInterface;
use App\Repositories\RepositoryInterface2;

class ProduitRepository implements RepositoryInterface, RepositoryInterface2
{
    // Produit property on class instances
    protected $Produit;

    // Constructor to bind Produit to repo
    public function __construct(Produit $Produit)
    {
        $this->Produit = $Produit;
    }

    // Get all instances of Produit
    public function all()
    {
        return $this->Produit->all();
    }
    // Get all instances of Produit
    public function get_by_agency($id)
    {
        return $this->Produit::where('agence_id', $id)->paginate(15);
    }
    public function get_by_client($id)
    {
        return $this->Produit::where('client_id', $id)->paginate(15);
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->Produit->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->Produit->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->Produit->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->clien->findOrFail($id);
    }

    // Get the associated Produit
    public function getProduit()
    {
        return $this->Produit;
    }

    // Set the associated Produit
    public function setProduit($Produit)
    {
        $this->Produit = $Produit;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->Produit->with($relations);
    }
}
