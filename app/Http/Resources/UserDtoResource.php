<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleDtoResource;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User Dto",
 *     required={"name", "email"},
 *     properties={
 *         @OA\Property(property="id", type="int64", example="1"),
 *         @OA\Property(property="name", type="string", example="Admin"),
 *         @OA\Property(property="email", type="string", example="user@domain.com"),
 *         @OA\Property(property="roles", type="array", @OA\Items(ref="#/components/schemas/RoleDtoResource")),
 *     }
 * )
 */
class UserDtoResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'roles' => RoleDtoResource::collection($this->roles)
        ];
    }
}
