<?php

namespace App\Virtual;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Todo showing request",
 *     description="Some simple request createa as tod",
 * )
 */
class TodoShowRequest
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="Unique ID",
     *     example="1",
     * )
     *
     * @var int
     */
    public $id;

    /**
     * @OA\Property(
     *     title="Title",
     *     description="Name of key for storring",
     *     example="New Todo",
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     title="Description",
     *     description="Value for storring",
     *     example="New Todo description",
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     title="Is Completed",
     *     description="Show if Todo is Completed",
     *     example="false"
     * )
     * @var boolean
     */
    public $is_completed;
}
