<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\UserDtoResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->save();
        $user->roles()->sync(collect($request->roles)->pluck('id'));
        $user->refresh();

        return response()->json(new UserDtoResource($user), Response::HTTP_CREATED);
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
        $rules = [];

        if (!is_null($request->password))
            $rules['password'] = 'required|string|min:8|max:255';

        if (strcasecmp($user->email, $request->email))
            $rules['email'] = 'unique:users,email';

        if (count($rules))
        {
            $validator = Validator::make($request->all(), $rules);
            $validator->validate();
        }

        if (is_null($request->password))
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }
        else
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }

        $user->save();
        $user->roles()->sync(collect($request->roles)->pluck('id'));
        $user->refresh();

        return response()->json(new UserDtoResource($user), Response::HTTP_OK);
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
        $validator = Validator::make($request->all(), [
            'password'      => 'required|string|min:8|max:255'
        ]);

        $validator->validate();

        $user->password = Hash::make($request->password);
        $user->save();
        $user->refresh();

        return response()->json(new UserDtoResource($user), Response::HTTP_OK);
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
        $user->delete();
        return response()->json(NULL, Response::HTTP_NO_CONTENT);
    }
}
