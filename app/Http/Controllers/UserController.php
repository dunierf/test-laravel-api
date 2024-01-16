<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserDtoResource;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/users",
     *      tags={"Users"},
     *      summary="Get users collection",
     *      description="Get a list of users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UserDtoResource"))
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
        return UserDtoResource::collection(User::orderBy('name')->get());
    }

    /**
     * @OA\Post(
     *      path="/api/users",
     *      tags={"Users"},
     *      summary="Create a user",
     *      description="Create a user",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Object",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="int64", example="1"),
     *              @OA\Property(property="name", type="string", example="Admin"),
     *              @OA\Property(property="email", type="string", example="user@domain.com"),
     *              @OA\Property(property="password", type="string", example="UserPass2024"),
     *              @OA\Property(property="roles", type="array", @OA\Items(ref="#/components/schemas/RoleDtoResource"))
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created user",
     *          @OA\JsonContent(ref="#/components/schemas/UserDtoResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/api/users/{id}",
     *      tags={"Users"},
     *      summary="Get a user",
     *      description="Get a user by id",
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
     *          @OA\JsonContent(ref="#/components/schemas/UserDtoResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function show(User $user)
    {
        return new UserDtoResource($user);
    }

    /**
     * @OA\Put(
     *      path="/api/users/{id}",
     *      tags={"Users"},
     *      summary="Update a user",
     *      description="Update a user",
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
     *      @OA\RequestBody(
     *          required=true,
     *          description="Object",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="int64", example="1"),
     *              @OA\Property(property="name", type="string", example="Admin"),
     *              @OA\Property(property="email", type="string", example="user@domain.com"),
     *              @OA\Property(property="password", type="string", example="UserPass2024"),
     *              @OA\Property(property="roles", type="array", @OA\Items(ref="#/components/schemas/RoleDtoResource"))
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Updated user",
     *          @OA\JsonContent(ref="#/components/schemas/UserDtoResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * @OA\Put(
     *      path="/api/users/{id}/password",
     *      tags={"Users"},
     *      summary="Update user's password",
     *      description="Update user's password",
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
     *      @OA\RequestBody(
     *          required=true,
     *          description="Object",
     *          @OA\JsonContent(
     *              @OA\Property(property="password", type="string", example="UserPass2024")
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="No Content"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      )
     * )
     */
    public function password(Request $request, User $user)
    {
        //
    }

    /**
     * @OA\Delete(
     *      path="/api/users/{id}",
     *      tags={"Users"},
     *      summary="Delete a user",
     *      description="Delete a user by id",
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
     *          response=204,
     *          description="No Content"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function destroy(User $user)
    {
        //
    }
}
