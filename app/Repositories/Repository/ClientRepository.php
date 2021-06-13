<?php

namespace App\Repositories\Repository;

use App\Http\Resources\ClientCollection;
use App\Models\Client;
use App\Models\User;
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
        if(auth()->user()->userable->role_id == 1){
            return new ClientCollection($this->client::whereHas('user')->get());
        }
        return new ClientCollection($this->client::whereHas('user', function($q) use ($id){
            $q->where('agence_id', $id);
        })->get());
    }
    public function get_by_agency_list($id)
    {
        return $this->client::whereHas('user', function($q) use ($id){
            $q->where('agence_id', $id);
        })->get();
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
        User::find($record->user->id)->update([
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
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
