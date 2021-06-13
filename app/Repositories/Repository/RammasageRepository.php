<?php

namespace App\Repositories\Repository;

use App\Models\Rammasage;
use App\Repositories\RepositoryInterface;

class RammasageRepository implements RepositoryInterface
{
    // Rammasage property on class instances
    protected $Rammasage;

    // Constructor to bind Rammasage to repo
    public function __construct(Rammasage $Rammasage)
    {
        $this->Rammasage = $Rammasage;
    }

    // Get all instances of Rammasage
    public function all()
    {
        return $this->Rammasage->all();
    }
    // Get all instances of Rammasage
    public function get_by_agency($id)
    {
        return $this->Rammasage::where('agence_id', $id)->with('colis')->with('user')->get();
    }
    public function get_by_client($id)
    {
        return $this->Rammasage::whereHas('colis', function ($colis) use ($id){
            $colis->where('client_id', $id);
        })->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->Rammasage->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->Rammasage->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->Rammasage->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->Rammasage->findOrFail($id);
    }

    // Get the associated Rammasage
    public function getRammasage()
    {
        return $this->Rammasage;
    }

    // Set the associated Rammasage
    public function setRammasage($Rammasage)
    {
        $this->Rammasage = $Rammasage;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->Rammasage->with($relations);
    }
}
