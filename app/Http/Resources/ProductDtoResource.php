<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product Dto",
 *     required={"name", "email"},
 *     properties={
 *         @OA\Property(property="id", type="int64", example="1"),
 *         @OA\Property(property="name", type="string", example="Admin"),
 *         @OA\Property(property="price", type="decimal", example="12.30"),
 *         @OA\Property(property="urlImg", type="string", example="http://www.domain.com/path/to/image.jpg")
 *     }
 * )
 */
class ProductDtoResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'price'  => $this->price,
            'image'  => $this->image,
            'description'  => $this->description
        ];
    }
}
