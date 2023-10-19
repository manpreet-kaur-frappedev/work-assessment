<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\UploadedFile;
use App\Models\Notification;
use App\Models\TaskComment;
use App\Http\Requests\TaskCreateRequest;
use Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->get();

        return view('tasks/index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = User::where('type', User::EMPLOYEE)->orderBy('id', 'desc')->get();

        return view('tasks/create', ['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request)
    {
        $requestData = $request->validated(); // This gets the validated data from the request
        $requestData['assignee'] = Auth::user()->id;

        $task = Task::create($requestData);

        if(!empty($request->document)) {
            // Store the uploaded file
            $fileName = time().'.'.$request->document->extension();
            $path = public_path('files/');
            $request->document->move($path, $fileName);
            $data = [];
            $data['task_id'] = $task->id;
            $data['user_id'] = Auth::user()->id;
            $data['filename'] = $fileName;

            $uploadedFiles = UploadedFile::create($data);

            Notification::createNotification($task->assign_to, 'New task has been assigned');
        }

        return redirect('/tasks')->with('success', "Employee created successfully!");
    }

    public function status($id, $type)
    {
        $task = Task::find($id);

        $task->status = $type;
        $task->save();
        
        return redirect('/')->with('success', "Employee updated successfully!");
    }

    public function settings($id)
    {
        $task = Task::find($id);

        return view('tasks/settings', ['task' => $task]);
    }

    public function saveSettings(Request $request, $id)
    {
        $task = Task::find($id);

        if($task) {
            if(!empty($request->document)) {
                // Store the uploaded file
                $fileName = time().'.'.$request->document->extension();
                $path = public_path('files/');
                $request->document->move($path, $fileName);
                $data = [];
                $data['task_id'] = $task->id;
                $data['user_id'] = Auth::user()->id;
                $data['filename'] = $fileName;

                $uploadedFiles = UploadedFile::create($data);
            }

            if(isset($request->comment) && (!empty($request->comment))) {
                $comment = [];
                $comment['task_id'] = $task->id;
                $comment['user_id'] = Auth::user()->id;
                $comment['comment'] = $request->comment;

                TaskComment::create($comment);
            }
        }

        return redirect('/');
    }
}