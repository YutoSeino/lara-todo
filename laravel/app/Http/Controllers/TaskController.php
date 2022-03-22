<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function store() {
        $user_id = Auth::id();
        $tags = Tag::where('user_id', $user_id)->get();
        $tasks = $this->task->where('user_id', $user_id)->get();
        return view('tasks.store', ['tags' => $tags, 'tasks' => $tasks]);
    }

    public function create(Request $request) {
        $data = $request->all();
        // dd($data);
        $exist_tag = Tag::where('name', $data['tag'])->where('user_id', $data['user_id'])->first();
        if( empty($exist_tag['id']) ){
            $tag_id = Tag::insertGetId(['name' => $data['tag'], 'user_id' => $data['user_id']]);
        }else{
            $tag_id = $exist_tag['id'];
        }
        $task = $this->task->create([
            'name' => $data['name'],
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'tag_id' => $tag_id,
        ]);
        
        return redirect()->route('task.store', ['id' => Auth::user()->id]);
    }
}
