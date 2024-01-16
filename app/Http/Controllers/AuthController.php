<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\AuthenticationFailedException;
use App\Http\Resources\RoleDtoResource;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      tags={"Auth"},
     *      summary="Login user",
     *      description="Login user",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Object",
     *          @OA\JsonContent(
     *              @OA\Property(property="email", type="string", example="user@domain.com"),
     *              @OA\Property(property="password", type="string", example="password")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created user",
     *          @OA\JsonContent(
     *              @OA\Property(property="token", type="string"),
     *          )
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
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (is_null($user) || (!Hash::check($request->password, $user->password)))
            throw new AuthenticationFailedException();

        return response()->json([
            'token' => $user->createToken('token')->plainTextToken
        ], Response::HTTP_CREATED);
    }

    /**
     * @OA\Delete(
     *      path="/api/auth/login",
     *      tags={"Auth"},
     *      summary="Logout user",
     *      description="Logout user",
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
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(NULL, Response::HTTP_NO_CONTENT);
    }

    /**
     * @OA\Get(
     *      path="/api/auth/roles",
     *      tags={"Auth"},
     *      summary="Get authed user's roles",
     *      description="Get authed user's roles",
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
    public function roles(Request $request)
    {
        return RoleDtoResource::collection($request->user()->roles);
    }
}
