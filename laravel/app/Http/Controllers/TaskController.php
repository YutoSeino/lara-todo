<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tag;
use App\Models\Timer;
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
        $timer = Timer::where('id', $task['timer_id'])->first();
        return view('tasks.edit', ['task' => $task, 'timer' => $timer]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        // dd($data);
        $exist_timer = Task::where('timer_id', $data['timer_id'])->where('id', $id)->first();
        if (empty($exist_timer['timer_id'])) {
            $timer = Timer::create([
                'time' => $data['time'],
                'elapsed_time' => $data['elapsed_time'],
                'user_id' => Auth::id()
            ]);
            $timer_id = $timer['id'];
        } else {
            $timer = Timer::where('id', $data['timer_id'])->update(['time' => $data['time'], 'elapsed_time' => $data['elapsed_time']]);
            $timer_id = $exist_timer['timer_id'];
        }
        Task::where('id', $id)->update(['name' => $data['name'], 'content' => $data['content'], 'status' => $data['status'], 'tag_id' => $data['tag_id'], 'timer_id' => $timer_id]);
        return redirect()->route('task.edit', ['id' => $id]);
    }
}
