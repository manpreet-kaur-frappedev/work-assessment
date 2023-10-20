<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'assignee',
        'assign_to',
        'status',
        'deadline',
        'document',
    ];

    public function assignTo()
    {
        return $this->belongsTo(User::class, 'assign_to', 'id');
    }

    public function assigneBy()
    {
        return $this->belongsTo(User::class, 'assignee', 'id');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class, 'task_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(UploadedFile::class, 'task_id', 'id');
    }

    // public function comments($taskId)
    // {
    //     return $this->hasMany(TaskComment::class, 'user_id', 'assign_to')->where('task_id', $taskId)->get();
    // }

    // public function files($taskId)
    // {
    //     return $this->hasMany(UploadedFile::class, 'user_id', 'assign_to')->where('task_id', $taskId)->get();
    // }
}
