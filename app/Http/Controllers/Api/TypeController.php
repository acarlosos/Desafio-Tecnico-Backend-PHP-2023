<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypePostRequest;
use App\Http\Requests\TypeUpdatedRequest;
use App\Repository\TypeRepository;
use App\Services\TypeService;

class TypeController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(TypeService $service, TypeRepository $repository) {
        $this->service = $service;
        $this->repository = $repository;
    }
    /**
     *  @OA\Get(
     *      path="/type",
     *      summary="Return Types",
     *      description="Return Types",
     *      operationId="type-index",
     *      tags={"Type"},
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
    *       @OA\Property(property="data", type="object",
    *           @OA\Property(property="types", type="array",
    *               @OA\Items(
    *                   @OA\Property(property="id", type="integer", example="1"),
    *                   @OA\Property(property="name", type="string", example="custom"),
    *               )
    *           )
    *       ),
     *        )
     *     ),
     *  @OA\Response(
     *    response=400,
     *    description="Wrong error",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="false"),
     *       @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *        )
     *     ),
     *  )
     * )
     */
    public function index()
    {
        try {
            $types = $this->repository->all()->sortBy('name');
            return response()->json(['data' => ['types' => $types ], 'status' => 'success','message' => 'List of types!' ]);
        } catch (\Exception $e) {
            return response()->json(["data" => [] , "status" => 'error', 'message' => $e->getMessage(), ], $e->getCode());
        }
    }

    /**
     * @OA\Post(
     * path="/type",
     * summary="Create type",
     * description="Create type",
     * operationId="type-store",
     * tags={"Type"},
     * security={ {"sanctum": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    description="Create type",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", example="danger"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="data", type="object",
     *          @OA\Property(property="type", type="object",
     *              @OA\Property(property="id", type="string", example="1"),
     *              @OA\Property(property="name", type="string", example="danger"),
     *          )
     *       ),
     *       @OA\Property(property="success", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="Type created with success"),
     *        )
     *     ),
     *  @OA\Response(
     *    response=400,
     *    description="Wrong error",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="false"),
     *       @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again!")
     *        )
     *     ),
     *  )
     * )
     */
    public function store(TypePostRequest $request)
    {
        try {
            if($type = $this->service->store($request->validated()) ){
                return response()->json(['data' => ['type' => $type ], 'status' => 'success','message' => 'Type created with success!' ]);
            }
            return response()->json(["data" => [] , "status" => 'error', 'message' => 'Sorry, wrong error. Please try again', ], 204);
        } catch (\Exception $e) {
            return response()->json(["data" => [] , "status" => 'error', 'message' => $e->getMessage(), ], $e->getCode());
        }

    }

/**
     * @OA\Get(
     * path="/type/{id}",
     * summary="Receive a type",
     * description="Receive a type",
     * operationId="type-show",
     * tags={"Type"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *      description="id",
     *      in="path",
     *      name="id",
     *      required=true,
     *      example="1",
     *      @OA\Schema(
     *          type="integer",
     *          format="int64"
     *      )
     *  ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(

     *       @OA\Property(property="data", type="object",
     *          @OA\Property(property="type", type="object",
     *              @OA\Property(property="id", type="integer", example="2"),
     *              @OA\Property(property="name", type="string", example="danger"),
     *          )
     *       ),
     *       @OA\Property(property="success", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="Comment updated"),
     *        )
     *     ),
     *  @OA\Response(
     *    response=400,
     *    description="Wrong error",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="false"),
     *       @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *        )
     *     ),
     * )
     */
    public function show($id)
    {

        try {
            if($type = $this->repository->find($id)){
                return response()->json(['data' => ['type' => $type ], 'status' => 'success','message' => 'Show Type!' ]);
            }
            return response()->json(["data" => [] , "status" => 'error', 'message' => 'Sorry, wrong error. Please try again', ], 400);
        } catch (\Exception $e) {
            return response()->json(["data" => [] , "status" => 'error', 'message' => $e->getMessage(), ], $e->getCode());
        }
    }




    /**
     * @OA\Put(
     * path="/type",
     * summary="Update type",
     * description="Update type",
     * operationId="type-put",
     * tags={"Type"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *      description="id",
     *      in="path",
     *      name="id",
     *      required=true,
     *      example="1",
     *      @OA\Schema(
     *          type="integer",
     *          format="int64"
     *      )
     *  ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Update type",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", example="Danger"),
     *    ),
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="data", type="object",
     *          @OA\Property(property="type", type="object",
     *              @OA\Property(property="id", type="string", example="1"),
     *              @OA\Property(property="name", type="string", example="danger"),
     *          )
     *       ),
     *       @OA\Property(property="success", type="boolean", example="true"),
     *       @OA\Property(property="message", type="string", example="Type created with success"),
     *        )
     *     ),
     *  @OA\Response(
     *    response=400,
     *    description="Wrong error",
     *    @OA\JsonContent(
     *       @OA\Property(property="success", type="boolean", example="false"),
     *       @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again!")
     *        )
     *     ),
     *  )
     * )
     */
    public function update(TypeUpdatedRequest $request, $id)
    {
        try {
            if( $type = $this->service->update($id, $request->validated() )  ){
                return response()->json(['data' => ['type' => $type ], 'status' => 'success','message' => 'Type updated with success!' ]);
            }
            return response()->json(["data" => [] , "status" => 'error', 'message' => 'Sorry, wrong error. Please try again', ], 204);
        } catch (\Exception $e) {
            return response()->json(["data" => [] , "status" => 'error', 'message' => $e->getMessage(), ], $e->getCode());
        }


    }

    /**
     * @OA\Delete(
     * path="/type/{id}",
     * summary="Delete type",
     * description="Delete type",
     * operationId="type-delete",
     * tags={"Type"},
     * security={ {"sanctum": {} }},
     * @OA\Parameter(
     *      description="id",
     *      in="path",
     *      name="id",
     *      required=true,
     *      example="1",
     *      @OA\Schema(
     *          type="integer",
     *          format="int64"
     *      )
     *  ),
     * @OA\Response(
     *      response=200,
     *      description="The resource was deleted successfully",
     *      @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example="true"),
     *           @OA\Property(property="message", type="string", example="The resource was deleted successfully")
     *      )
     *  ),
     *  @OA\Response(
     *      response=400,
     *      description="Wrong error",
     *      @OA\JsonContent(
     *          @OA\Property(property="success", type="boolean", example="false"),
     *          @OA\Property(property="message", type="string", example="Sorry, wrong error. Please try again")
     *      )
     *  ),
     * )
     */
    public function destroy($id)
    {
        try {
            if( $this->service->delete($id) ){
                return response()->json(['data' => ['type' => [] ], 'status' => 'success','message' => 'The resource was deleted successfully!' ]);
            }
            return response()->json(["data" => [] , "status" => 'error', 'message' => 'Sorry, wrong error. Please try again', ], 204);
        } catch (\Exception $e) {
            return response()->json(["data" => [] , "status" => 'error', 'message' => $e->getMessage(), ], $e->getCode());
        }
    }
}
