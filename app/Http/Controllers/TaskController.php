<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * @property TaskService $service
     */
    private TaskService $service;

    /**
     * Construct
     */
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }
    /**
     * @OA\Get(
     *     tags={"Tasks"},
     *     path="/api/tasks",
     *     summary="Get all tasks",
     *     @OA\Parameter(
     *            name="search",
     *            description="Filter. Key value for search",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="string",
     *                example=""
     *            )
     *        ),
     *        @OA\Parameter(
     *            name="date_column",
     *            description="Filter. Between date column.",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="string",
     *                example=""
     *            )
     *        ),
     *       @OA\Parameter(
     *            name="date_from",
     *            description="Filter. Between from date",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="datetime",
     *                example=""
     *            )
     *        ),
     *       @OA\Parameter(
     *            name="date_to",
     *            description="Filter. Between to date",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="datetime",
     *                example=""
     *            )
     *        ),
     *       @OA\Parameter(
     *            name="order_column",
     *            description="Sort. Column name.",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="string",
     *                example="created_at"
     *            )
     *        ),
     *       @OA\Parameter(
     *            name="order_type",
     *            description="Sort. Type.",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="string",
     *                example="desc"
     *            )
     *        ),
     *       @OA\Parameter(
     *            name="per_page",
     *            description="Pagination. Per page value.",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="integer",
     *                example="15"
     *            )
     *        ),
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks"
     *     )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(TaskRequest $request): JsonResponse
    {
        return response()->json($this->service->list($request->validated()));
    }


    /**
     * @OA\Post(path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Store",
     *     description="Create single.",
     *     operationId="storeTask",
     *     security={ {"bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="title",
     *          description="Title of task",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example=""
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="description",
     *          description="Description of task",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example=""
     *          )
     *      ),
     *     @OA\Parameter(
     *           name="status",
     *           description="Status of task",
     *           in="query",
     *           required=false,
     *           @OA\Schema(
     *               type="string",
     *               enum={"pending","in_progress","completed"}
     *           )
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(),
     *         @OA\Schema(
     *             additionalProperties={
     *                 "type": "integer",
     *                 "format": "int32"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized.",
     *         @OA\Schema(
     *             additionalProperties={
     *                 "type": "integer",
     *                 "format": "int32"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden.",
     *         @OA\Schema(
     *             additionalProperties={
     *                 "type": "integer",
     *                 "format": "int32"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content.",
     *         @OA\Schema(
     *             additionalProperties={
     *                 "type": "integer",
     *                 "format": "int32"
     *             }
     *         )
     *     )
     * )
     *
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest $request
     * @return JsonResponse
     */
    public function store(TaskRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()),201);
    }

    /**
     *
     * @OA\Get(path="/api/tasks/{id}",
     *      tags={"Tasks"},
     *      summary="Get one item",
     *      description="Get single.",
     *       @OA\Parameter(
     *           name="id",
     *           description="ID",
     *           in="path",
     *           required=true,
     *           @OA\Schema(
     *               type="string",
     *               example=""
     *           )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      )
     *  )
     *
     *
     *
     * @param TaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(TaskRequest $request, int $id): JsonResponse{
        return response()->json($this->service->get($id));
    }

    /**
     * @OA\Put(path="/api/tasks/{id}",
     *      tags={"Tasks"},
     *      summary="Update",
     *      description="Update data single.",
     *     @OA\Parameter(
     *           name="id",
     *           description="ID",
     *           in="query",
     *           required=true,
     *           @OA\Schema(
     *               type="integer",
     *               example="1"
     *           )
     *       ),
     *       @OA\Parameter(
     *           name="title",
     *           description="Title of task",
     *           in="query",
     *           required=false,
     *           @OA\Schema(
     *               type="string",
     *               example=""
     *           )
     *       ),
     *      @OA\Parameter(
     *           name="description",
     *           description="Description of task",
     *           in="query",
     *           required=false,
     *           @OA\Schema(
     *               type="string",
     *               example=""
     *           )
     *       ),
     *      @OA\Parameter(
     *            name="status",
     *            description="Status of task",
     *            in="query",
     *            required=false,
     *            @OA\Schema(
     *                type="string",
     *                enum={"pending","in_progress","completed"}
     *            )
     *        ),
     *          @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(),
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      )
     *  )
     *
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function update(TaskRequest $request): JsonResponse
    {
        return response()->json($this->service->update($request->validated('id'), $request->validated()));
    }

    /**
     *
     * @OA\Delete(path="/api/tasks/{id}",
     *      tags={"Tasks"},
     *      summary="Delete item",
     *      description="Delete single item",
     *       @OA\Parameter(
     *           name="id",
     *           description="ID",
     *           in="path",
     *           required=true,
     *           @OA\Schema(
     *               type="string",
     *               example=""
     *           )
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not found.",
     *          @OA\Schema(
     *              additionalProperties={
     *                  "type": "integer",
     *                  "format": "int32"
     *              }
     *          )
     *      ),
     *  )
     * @param TaskRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function delete(TaskRequest $request, int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(['message' =>'success deleted', 'status' => true]);
    }

}
