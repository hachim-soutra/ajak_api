<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function get_by_agency($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}
