<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Repositories\DeviceRepository;
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;

class DeviceController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected DeviceRepository $device,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->device->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->device->create($request->all());
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->device->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->device->update($request->all() , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->device->delete($id);
            return 'Successfully deleted';
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
