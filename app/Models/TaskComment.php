<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TaskComment extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_id',
        'user_id',
        'comment',
    ];

    public function getCreatedAtAttribute($value)
    {
        $carbonDate = Carbon::parse($value);
        return $carbonDate->diffForHumans();
    }
}
