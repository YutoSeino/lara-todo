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
        return view('tasks.store');
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

    public function edit($id) {
        $user_id = Auth::id();

        $task = Task::where('id', $id)->where('user_id', $user_id)->first();

        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        // dd($data);
        Task::where('id', $id)->update(['name' => $request['name'], 'content' => $request['content'], 'tag_id' => $request['tag_id']]);
        return redirect()->route('task.edit', ['id' => $id]);
    }
}
