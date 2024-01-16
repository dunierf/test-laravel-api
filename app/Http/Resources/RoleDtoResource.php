<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="Role",
 *     description="Role Dto",
 *     required={"name"},
 *     properties={
 *         @OA\Property(property="id", type="int64", example="1"),
 *         @OA\Property(property="name", type="string", example="Admin")
 *     }
 * )
 */

class RoleDtoResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name
        ];
    }
}
