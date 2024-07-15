<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Repositories\GroupRepository;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected GroupRepository $group,
    ) {}

    /**
     * @OA\Get(
     *     path="/api/groups",
     *     summary="Get list of groups",
     *     tags={"Groups"},
     *     security={{"passport":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function index()
    {
        return $this->group->all();
    }

    /**
     * @OA\Post(
     *     path="/api/groups",
     *     summary="Create a group",
     *     tags={"Groups"},
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
     *                      example="Ben Group"
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
        $result = $this->group->create($request->all());
        return $result;
    }

    /**
     * @OA\Get(
     *     path="/api/groups/{id}",
     *     summary="Show details of a group",
     *     tags={"Groups"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the order to update"
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function show($id)
    {
        return $this->group->find($id);
    }

    /**
     * @OA\Put(
     *     path="/api/groups/{id}",
     *     summary="Update a group",
     *     tags={"Groups"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the group to update"
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
     *                              example="Ben Group"
     *                          ),
     *                          @OA\Property(
     *                              property="status",
     *                              type="string",
     *                              example=1,
     *                              description="Status of the group. 1 or 0"
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
        return $this->group->update($request->all() , $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/groups/{id}",
     *     summary="Delete a group",
     *     tags={"Groups"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Id of the order to delete"
     *     ),
     *     @OA\Response(response=200, description="Successful deleted"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function destroy($id)
    {
        try {
            $this->group->delete($id);
            return 'Successfully deleted';
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
