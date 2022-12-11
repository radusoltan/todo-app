<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TodoController extends Controller
{
    /**
     *
     * @OA\Get(
     *     path="/todos",
     *     operationId="todosAll",
     *     tags={"Todos"},
     *     summary="Display a listing of the Todos",
     *
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     * )
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Todo::all();
    }

    /**
     *
     * @OA\Get(
     *     path="/todo/{todo}",
     *     operationId="todoGet",
     *     tags={"Todos"},
     *     summary="Get todo by ID",
     *     @OA\Parameter(
     *         name="todo",
     *         in="path",
     *         description="The ID of todo",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *
     * )
     *
     * @param Todo $todo
     * @return Todo
     */
    public function show(Todo $todo): Todo
    {
        return $todo;
    }

    /**
     *
     * @OA\Post(
     *     path="/todos",
     *     operationId="todoCreate",
     *     tags={"Todos"},
     *     summary="Create new todo record",
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/TodoShowRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TodoShowRequest")
     *     ),
     * )
     *
     * @param Request $request
     * @return Todo
     */
    public function store(Request $request): Todo
    {

        $request->validate([
            'title' => 'required'
        ]);

        return Todo::create([
            'title' => $request->get('title'),
            'description' => $request->get('description') ?? null,
            'is_completed' => $request->get('completed') ?? false
        ]);

    }

    /**
     *
     * @OA\Patch(
     *     path="/todo/{todo}",
     *     operationId="todoUpdate",
     *     tags={"Todos"},
     *     summary="Update tod by ID",
     *     @OA\Parameter(
     *         name="todo",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/TodoShowRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TodoStoreRequest")
     *     ),
     * )
     * @param Request $request
     * @param Todo $todo
     * @return Todo
     */
    public function update(Request $request, Todo $todo): Todo
    {
        $request->validate([
            'title' => 'required'
        ]);

        $todo->update([
            'title' => $request->get('title'),
            'description' => $request->get('description') ?? null,
            'is_completed' => $request->get('completed') ?? false
        ]);

        return $todo;
    }

    /**
     * @OA\Post(
     *     path="/todo/{todo}/complete",
     *     operationId="todoSetCompleted",
     *     tags={"Todos"},
     *     summary="Set TODO as completed",
     *     @OA\Parameter(
     *         name="todo",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/TodoShowRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TodoStoreRequest")
     *     ),
     * )
     * @param Todo $todo
     * @return bool
     */
    public function setTodoAsComplete(Todo $todo): bool
    {
        return $todo->update([
            'is_completed' => true
        ]);
    }

    /**
     *
     * @OA\Post(
     *     path="/todo/{todo}/incomplete",
     *     operationId="todoSetInompleted",
     *     tags={"Todos"},
     *     summary="Set TODO as incompleted",
     *     @OA\Parameter(
     *         name="todo",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\JsonContent(ref="#/components/schemas/TodoShowRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TodoStoreRequest")
     *     ),
     * )
     *
     * @param Todo $todo
     * @return bool
     */
    public function setTodoAsIncomplete(Todo $todo): bool
    {
        return $todo->update([
            'is_completed' => false
        ]);
    }

    /**
     *
     * @OA\Delete(
     *     path="/todo/{todo}",
     *     operationId="deleteTodo",
     *     tags={"Todos"},
     *     summary="Delete TODO",
     *     @OA\Parameter(
     *         name="todo",
     *         in="path",
     *         description="The ID of example",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Everything is fine",
     *      )
     * )
     *
     * @param Todo $todo
     * @return bool|null
     */
    public function destroy(Todo $todo)
    {

        return $todo->delete();

    }

    /**
     *
     * @OA\Get(
     *     path="/todos/completed",
     *     operationId="todoGetCompleted",
     *     tags={"Todos"},
     *     summary="Get list of completed Toodos",
     *
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     * )
     *
     * @return Collection
     */
    public function getCompletedTodos(): Collection
    {

        return Todo::where('is_completed', true)->get();

    }

    /**
     *  @OA\Get(
     *     path="/todos/incompleted",
     *     operationId="todoGetInompleted",
     *     tags={"Todos"},
     *     summary="Get list of incompleted Toodos",
     *
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     * )
     * @return Collection
     */
    public function getIncompleteTodos(): Collection
    {
        return Todo::where('is_completed', false)->get();
    }
}
