<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\RoleDtoResource;

class RoleController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/roles",
     *      tags={"Roles"},
     *      summary="Get roles collection",
     *      description="Get a list of roles",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/RoleDtoResource"))
     *          )
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function index()
    {
        return RoleDtoResource::collection(Role::orderBy('name')->get());
    }

    /**
     * @OA\Get(
     *      path="/api/roles/{id}",
     *      tags={"Roles"},
     *      summary="Get a role",
     *      description="Get a role by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example=1
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RoleDtoResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function show(Role $role)
    {
        return new RoleDtoResource($role);
    }
}
