<?php

namespace App\Repositories\Repository;

use App\Models\Client;
use App\Repositories\RepositoryInterface;

class ClientRepository implements RepositoryInterface
{
    // client property on class instances
    protected $client;

    // Constructor to bind client to repo
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    // Get all instances of client
    public function all()
    {
        return $this->client->all();
    }
    // Get all instances of client
    public function get_by_agency($id)
    {
        return $this->client::where('agence_id', $id)->paginate(15);
    }
    public function get_by_agency_list($id)
    {
        return $this->client::where('agence_id', $id)->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->client->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->client->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->client->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->client->findOrFail($id);
    }

    // Get the associated client
    public function getclient()
    {
        return $this->client;
    }

    // Set the associated client
    public function setclient($client)
    {
        $this->client = $client;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->client->with($relations);
    }
}
