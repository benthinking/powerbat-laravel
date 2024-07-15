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
     * @OA\Get(
     *     path="/api/points",
     *     summary="Get a list of points",
     *     tags={"Points"},
     *     security={{"passport":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function index()
    {
        return $this->point->all();
    }

    /**
     * @OA\Post(
     *     path="/api/points",
     *     summary="Create a point",
     *     tags={"Points"},
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
     *                      example="Ben Site"
     *                  ),
     *                  @OA\Property(
     *                      property="site_id",
     *                      type="string",
     *                      description="ID of the site",
     *                      example=1
     *                  ),
     *                  @OA\Property(
     *                      property="meta",
     *                      type="object",
     *                      example={"deserunt","amet","sit","illo","labore"}
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="string",
     *                      example=1,
     *                      description="Status of the point. 1 or 0"
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
        $result = $this->point->create($request->all());
        return $result;
    }

    /**
     * @OA\Get(
     *     path="/api/points/{id}",
     *     summary="Show details of a point",
     *     tags={"Points"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the point to update"
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function show($id)
    {
        return $this->point->find($id);
    }

    /**
     * @OA\Put(
     *     path="/api/points/{id}",
     *     summary="Update a point",
     *     tags={"Points"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the point to update"
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
     *                              example="Ben Site"
     *                          ),
     *                          @OA\Property(
     *                              property="site_id",
     *                              type="string",
     *                              description="ID of the site",
     *                              example=1
     *                          ),
     *                          @OA\Property(
     *                              property="meta",
     *                              type="object",
     *                              example={"deserunt","amet","sit","illo","labore"}
     *                          ),
     *                          @OA\Property(
     *                              property="status",
     *                              type="string",
     *                              example=1,
     *                              description="Status of the point. 1 or 0"
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
        return $this->point->update($request->all() , $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/points/{id}",
     *     summary="Delete a point",
     *     tags={"Points"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Id of the point to delete"
     *     ),
     *     @OA\Response(response=200, description="Successful deleted"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
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
