<?php

namespace App\Repositories\Repository;

use App\Http\Resources\AgenceCollection;
use App\Http\Resources\AgenceResource;
use App\Models\Agence;
use App\Repositories\RepositoryInterface;

class AgenceRepository implements RepositoryInterface
{
    // Agence property on class instances
    protected $Agence;

    // Constructor to bind Agence to repo
    public function __construct(Agence $Agence)
    {
        $this->Agence = $Agence;
    }

    // Get all instances of Agence
    public function all()
    {
        return new AgenceCollection($this->Agence->all());
    }
    // Get all instances of Agence
    public function get_by_agency($id)
    {
        return $this->Agence::where('agence_id', $id)->get();
    }
    public function get_by_agency_list($id)
    {
        return $this->Agence::where('agence_id', $id)->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->Agence->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->Agence->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->Agence->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return new AgenceResource($this->Agence->findOrFail($id));
    }

    // Get the associated Agence
    public function getAgence()
    {
        return $this->Agence;
    }

    // Set the associated Agence
    public function setAgence($Agence)
    {
        $this->Agence = $Agence;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->Agence->with($relations);
    }
}
