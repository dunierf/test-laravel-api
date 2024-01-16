<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductDtoResource;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/products",
     *      tags={"Products"},
     *      summary="Get products collection",
     *      description="Get a list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ProductDtoResource"))
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
        return ProductDtoResource::collection(Product::orderBy('name')->get());
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      tags={"Products"},
     *      summary="Create a product",
     *      description="Create a product",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Object",
     *          @OA\JsonContent(ref="#/components/schemas/ProductDtoResource")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created product",
     *          @OA\JsonContent(ref="#/components/schemas/ProductDtoResource")
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
     *      path="/api/products/{id}",
     *      tags={"Products"},
     *      summary="Get a product",
     *      description="Get a product by id",
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
     *          @OA\JsonContent(ref="#/components/schemas/ProductDtoResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found"
     *      )
     * )
     */
    public function show(Product $product)
    {
        return new ProductDtoResource($product);
    }

    /**
     * @OA\Put(
     *      path="/api/products/{id}",
     *      tags={"Products"},
     *      summary="Update a product",
     *      description="Update a product",
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
     *          @OA\JsonContent(ref="#/components/schemas/ProductDtoResource")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Updated user",
     *          @OA\JsonContent(ref="#/components/schemas/ProductDtoResource")
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
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * @OA\Delete(
     *      path="/api/products/{id}",
     *      tags={"Products"},
     *      summary="Delete a product",
     *      description="Delete a product by id",
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
    public function destroy(Product $product)
    {
        //
    }
}
