<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function clearAll()
    {
        $user = \Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        
        return back();
    }

    public function applyNotification(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $content = $request->input('content');

        Notification::create([
            'user_id' => $employeeId,
            'content' => $content
        ]);

        return response()->json(['message' => 'Notification sent successfully!']);
    }
}
