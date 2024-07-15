<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected OrderRepository $order,
    ) {}

    /**
     * @OA\Get(
     *     path="/api/orders",
     *     summary="Get list of orders",
     *     tags={"Orders"},
     *     security={{"passport":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function index()
    {
        return $this->order->all();
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Create a order",
     *     tags={"Orders"},
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
     *                      example="Ben Order"
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
        $result = $this->order->create($request->all());
        return $result;
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}",
     *     summary="Show details of an order",
     *     tags={"Orders"},
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
        return $this->order->find($id);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}",
     *     summary="Update an order",
     *     tags={"Orders"},
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
     *                              example="Ben Order"
     *                          ),
     *                          @OA\Property(
     *                              property="status",
     *                              type="string",
     *                              example=1,
     *                              description="Status of the order. 1 or 0"
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
        return $this->order->update($request->all() , $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/orders/{id}",
     *     summary="Delete an order",
     *     tags={"Orders"},
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
            $this->order->delete($id);
            return 'Successfully deleted';
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
