<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use App\Repositories\PointRepository;
use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;

class PointController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected PointRepository $point,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->point->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = $this->point->create($request->all());
        return $result;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->point->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->point->update($request->all() , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->point->delete($id);
            return 'Successfully deleted';
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
