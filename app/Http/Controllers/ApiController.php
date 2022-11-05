<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ApiController extends Controller
{


    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="All products",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="findPetsByStatus",
     *     @OA\Parameter(
     *         name="products",
     *         in="query",
     *         description="All products",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     *      security={
     *         {"bearer_token": {}}
     *     },
     * )
     */
    public function Products(){
        $model = Products::all();
        return response()->json($model);
    }

    /**
     * @OA\Post(
     *     path="/api/storeproducts",
     *     tags={"Products"},
     *     summary="Updates or create Products",
     *     operationId="storeProducts",

     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"bearer_token": {}}
     *     },
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Updated name of the pet",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="Enter product price",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="quantity",
     *                     description="Enter product quantity",
     *                     type="integer"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function storeProducts(Request $request){
        $model = new Products();
        $model->name = $request->name;
        $model->price = $request->price;
        $model->quantity = $request->quantity;
        $model->save();
        $response = [
            'data'=>$model,
            'status'=>'success'
        ];
        return response()->json($response);
    }
}
