<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'read_at'
    ];

    public static function createNotification($userId, $content)
    {
        // Create a new instance of the Notification model
        $notification = new Notification;

        $notification->user_id = $userId;
        $notification->content = $content;
        $notification->save();

        return $notification;
    }

    public function getCreatedAtAttribute($value)
    {
        $carbonDate = Carbon::parse($value);
        return $carbonDate->diffForHumans();
    }
}
