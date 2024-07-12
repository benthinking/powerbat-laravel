<?php

namespace App\Interfaces;

interface GroupRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update(array $data , $id);

    public function delete($id);
}
