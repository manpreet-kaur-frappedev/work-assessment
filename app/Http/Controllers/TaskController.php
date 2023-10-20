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
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }

    public function index()
    {
        $tasks = Task::orderBy('id', 'desc');
        
        if(Auth::user()->isEmployee()) {
            $tasks->whereAssignTo(Auth::user()->id);
        }

        $employees = User::where('type', User::EMPLOYEE)->orderBy('id', 'desc')->get();

        return view('tasks/index', ['tasks' => $tasks->get(), 'employees' => $employees]);
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
        $task = Task::findOrFail($id);

        if (!Gate::allows('task-status-change', $task)) {
            abort(403);
        }

        $task->status = $type;
        $task->save();
        
        return back()->with('success', "Status changed successfully!");
    }

    public function settings($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks/settings', ['task' => $task]);
    }

    // Handles uploads & comments
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

        return back();
    }

    // Get Comments
    public function comments($taskId)
    {
        $task = Task::findOrFail($taskId);

        $this->authorize('view', $task);

        return view('tasks.comments', ['task' => $task, 'comments' => $task->comments]);
    }

    public function uploadedFiles($taskId)
    {
        $task = Task::findOrFail($taskId);

        $this->authorize('view', $task);

        return view('tasks.files', ['task' => $task, 'files' => $task->files]);
    }

    public function addComment(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $this->validate($request, [
            'comment' => 'required'
        ]);

        if (!Gate::allows('task-comments', $task)) {
            abort(403);
        }

        $task = TaskComment::create([
            'comment' => $request->comment,
            'task_id' => $task->id,
            'user_id' => Auth::user()->id
        ]);

        return back();
    }

    public function uploadFile(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        if (!Gate::allows('task-uploads', $task)) {
            abort(403);
        }

        // Store the uploaded file
        $fileName = time().'.'.$request->document->extension();
        $path = public_path('files/');
        $request->document->move($path, $fileName);
        $data = [];
        $data['task_id'] = $taskId;
        $data['user_id'] = Auth::user()->id;
        $data['filename'] = $fileName;

        $uploadedFiles = UploadedFile::create($data);

        return back();
    }

    public function assignedTo(Request $request)
    {
        $taskId = $request->task_id;
        $userId = $request->user_id;
        
        $task = Task::findOrFail($taskId);
        
        if (!Gate::allows('task-assign', $task)) {
            abort(403);
        }
        
        $task->assign_to = $userId;
        $task->save();

        return response()->json(['success' => true, 'message' => 'Task assigned successfully!']);
    }
}
