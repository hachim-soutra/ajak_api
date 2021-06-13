<?php

namespace App\Repositories\Repository;

use App\Models\Livreur;
use App\Repositories\RepositoryInterface;

class LivreurRepository implements RepositoryInterface
{
    // Livreur property on class instances
    protected $Livreur;

    // Constructor to bind Livreur to repo
    public function __construct(Livreur $Livreur)
    {
        $this->Livreur = $Livreur;
    }

    // Get all instances of Livreur
    public function all()
    {
        return $this->Livreur->all();
    }
    // Get all instances of Livreur
    public function get_by_agency($id)
    {
        return $this->Livreur::where('agence_id', $id)->get();
    }
    public function get_by_agency_list($id)
    {
        return $this->Livreur::where('agence_id', $id)->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->Livreur->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->Livreur->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->Livreur->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->Livreur->findOrFail($id);
    }

    // Get the associated Livreur
    public function getLivreur()
    {
        return $this->Livreur;
    }

    // Set the associated Livreur
    public function setLivreur($Livreur)
    {
        $this->Livreur = $Livreur;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->Livreur->with($relations);
    }
}
