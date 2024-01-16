<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/auth",
     *      tags={"Auth"},
     *      summary="Login user",
     *      description="Login user",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Object",
     *          @OA\JsonContent(
     *              @OA\Property(property="username", type="string", example="root"),
     *              @OA\Property(property="password", type="string", example="UserPass2024")
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
        //
    }

    /**
     * @OA\Delete(
     *      path="/api/auth",
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
        //
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
        //
    }
}
