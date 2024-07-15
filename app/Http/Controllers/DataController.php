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
     * @OA\Get(
     *     path="/api/data",
     *     summary="Get list of data",
     *     tags={"Data"},
     *     security={{"passport":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function index()
    {
        return $this->data->all();
    }

    /**
     * @OA\Post(
     *     path="/api/data",
     *     summary="Create a data",
     *     tags={"Data"},
     *     security={{"passport":{}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      example="Ben Data"
     *                  ),
     *                  @OA\Property(
     *                      property="point_id",
     *                      type="integer",
     *                      example=1,
     *                      description="Id of a point"
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="string",
     *                      example=1,
     *                      description="Status of the data. 1 or 0"
     *                  )
     *              )
     *          )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function store(Request $request)
    {
        $result = $this->data->create($request->all());
        return $result;
    }

    /**
     * @OA\Get(
     *     path="/api/data/{id}",
     *     summary="Show details of a data",
     *     tags={"Data"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the data to update"
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function show($id)
    {
        return $this->data->find($id);
    }

    /**
     * @OA\Put(
     *     path="/api/data/{id}",
     *     summary="Update a data",
     *     tags={"Data"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the data to update"
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *               @OA\Schema(
     *                  oneOf={
     *                      @OA\Schema(
     *                          type="object",
     *                          @OA\Property(
     *                              property="name",
     *                              type="string",
     *                              example="Ben Data"
     *                          ),
     *                          @OA\Property(
     *                              property="point_id",
     *                              type="integer",
     *                              example="1"
     *                          ),
     *                          @OA\Property(
     *                              property="status",
     *                              type="string",
     *                              example=1,
     *                              description="Status of the data. 1 or 0"
     *                          )
     *                     )
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->data->update($request->all() , $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/data/{id}",
     *     summary="Delete a data",
     *     tags={"Data"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Id of the data to delete"
     *     ),
     *     @OA\Response(response=200, description="Successful deleted"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
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
