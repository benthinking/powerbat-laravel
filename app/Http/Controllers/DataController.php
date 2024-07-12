<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use App\Repositories\DataRepository;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected DataRepository $data,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->data->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->data->create($request->all());
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->data->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->data->update($request->all() , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->data->delete($id);
            return 'Successfully deleted';
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
