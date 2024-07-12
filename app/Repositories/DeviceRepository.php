<?php

namespace App\Repositories;

use App\Models\Device;
use App\Interfaces\DeviceRepositoryInterface;

class DeviceRepository implements DeviceRepositoryInterface
{
    protected $model;

    public function __construct(Device $model)
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