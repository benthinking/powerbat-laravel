<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Repositories\SiteRepository;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;

class SiteController extends Controller
{

    /**
     * @OA\Info(
     *   title="Laravel API v2",
     *   version="1.0.0",
     *   contact={
     *     "email": "ybier@esme-solutions.com"
     *   }
     * )
     */
    public function __construct(
        protected SiteRepository $site,
    ) {}

    /**
     * @OA\Get(
     *     path="/api/sites",
     *     summary="Get a list of sites",
     *     tags={"Sites"},
     *     security={{"passport":{}}},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function index()
    {
        return $this->site->all();
    }

    /**
     * @OA\Post(
     *     path="/api/sites",
     *     summary="Create a site",
     *     tags={"Sites"},
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
     *                      property="key",
     *                      type="string",
     *                      example="010000BEN1"
     *                  ),
     *                  @OA\Property(
     *                      property="address",
     *                      type="string",
     *                      example="123 Baker St"
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
        $result = $this->site->create($request->all());
        return $result;
    }

    /**
     * @OA\Get(
     *     path="/api/sites/{id}",
     *     summary="Get details of a site",
     *     tags={"Sites"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Id of the site to update"
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function show($id)
    {
        return $this->site->find($id);
    }

    /**
     * @OA\Put(
     *     path="/api/sites/{id}",
     *     summary="Update a site",
     *     tags={"Sites"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Id of the site to update"
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  oneOf={
     *                      @OA\Schema(
     *                          type="object",
     *                          @OA\Property(
     *                              property="name",
     *                              type="string",
     *                              example="Ben Site"
     *                          ),
     *                          @OA\Property(
     *                              property="key",
     *                              type="string",
     *                              example="010000BEN1"
     *                          ),
     *                          @OA\Property(
     *                              property="address",
     *                              type="string",
     *                              example="123 Baker St"
     *                          )
     *                      )
     *                  }
     *              ),
     *          )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function update(Request $request, $id)
    {
        return $this->site->update($request->all() , $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/sites/{id}",
     *     summary="Delete a site",
     *     tags={"Sites"},
     *     security={{"passport":{}}},
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          ),
     *          description="Id of the site to delete"
     *     ),
     *     @OA\Response(response=200, description="Successful deleted"),
     *     @OA\Response(response=401, description="Unauthorized Access")
     * )
     */
    public function destroy($id)
    {
        try {
            $this->site->delete($id);
            return 'Successfully deleted';
        } catch (\Throwable $th) {
            //throw $th;
            throw $th;
        }
    }
}
