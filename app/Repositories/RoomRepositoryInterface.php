<?php

namespace App\Repositories;

interface RoomRepositoryInterface
{
    public function search(String $search);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
}
