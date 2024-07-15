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
     * @OA\Get(
     *     path="/api/devices",
     *     summary="Get list of devices",
     *     tags={"Devices"},
     *     security={{"passport":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function index()
    {
        return $this->device->all();
    }

    /**
     * @OA\Post(
     *     path="/api/devices",
     *     summary="Create a device",
     *     tags={"Devices"},
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
     *                      example="Ben Device"
     *                  ),
     *                  @OA\Property(
     *                      property="status",
     *                      type="string",
     *                      example=1,
     *                      description="Status of the device. 1 or 0"
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
        $result = $this->device->create($request->all());
        return $result;
    }

    /**
     * @OA\Get(
     *     path="/api/devices/{id}",
     *     summary="Show details of a device",
     *     tags={"Devices"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the device to update"
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function show($id)
    {
        return $this->device->find($id);
    }

    /**
     * @OA\Put(
     *     path="/api/devices/{id}",
     *     summary="Update a device",
     *     tags={"Devices"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Id of the device to update"
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
     *                              example="Ben Device"
     *                          ),
     *                          @OA\Property(
     *                              property="status",
     *                              type="string",
     *                              example=1,
     *                              description="Status of the device. 1 or 0"
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
        return $this->device->update($request->all() , $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/devices/{id}",
     *     summary="Delete a device",
     *     tags={"Devices"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Id of the device to delete"
     *     ),
     *     @OA\Response(response=200, description="Successful deleted"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
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
