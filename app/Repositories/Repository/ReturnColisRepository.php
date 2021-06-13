<?php

namespace App\Repositories\Repository;

use App\Models\Colis;
use App\Models\ReturnColis;
use App\Repositories\RepositoryInterface;

class ReturnColisRepository implements RepositoryInterface
{
    // colis property on class instances
    protected $colis;

    // Constructor to bind colis to repo
    public function __construct(ReturnColis $colis)
    {
        $this->colis = $colis;
    }

    // Get all instances of colis
    public function all()
    {
        return $this->colis->all();
    }
    // Get all instances of colis
    public function get_by_agency($id)
    {
        return $this->colis::where('agence_id', $id)->get();
    }
    public function get_by_client($id)
    {
        return $this->colis::where('client_id', $id)->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->colis->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->colis->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->colis->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->colis->findOrFail($id);
    }

    // Get the associated colis
    public function getcolis()
    {
        return $this->colis;
    }

    // Set the associated colis
    public function setcolis($colis)
    {
        $this->colis = $colis;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->colis->with($relations);
    }
}
