<?php

namespace App\Repositories;

use App\Models\Data;
use App\Interfaces\DataRepositoryInterface;

class DataRepository implements DataRepositoryInterface
{
    protected $model;

    public function __construct(Data $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data , $id)
    {
       return tap($this->model->findOrFail($id))->update($data);
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    // ... Implement any other methods you have defined
}