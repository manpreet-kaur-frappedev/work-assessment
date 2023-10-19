<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($task) {
            return [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'assigned_by' => $task->assigneBy ? $task->assigneBy->name : '',
                'assigned_to' => $task->assignTo ? $task->assignTo->name : '',
                'status' => $task->status,
                'deadline' => $task->deadline,
            ];
        })->toArray();
    }
}
