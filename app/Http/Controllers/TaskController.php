<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Get all tasks",
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks"
     *     )
     * )
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Task::all());
    }
}
