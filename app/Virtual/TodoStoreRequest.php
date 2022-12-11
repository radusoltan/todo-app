<?php

namespace App\Virtual;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Todo storring request",
 *     description="Some simple request createa as todo",
 * )
 */
class TodoStoreRequest
{
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
     *     description="Show if Todo is completed",
     *     example="false"
     * )
     * @var boolean
     */
    public $is_completed;
}
