<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tag;
use App\Models\Calendar;
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
        // dd($tag_id);
        $calendar = Calendar::create([
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'event_name' => $data['name'],
            'user_id' => $data['user_id']
        ]);
        // dd($calendar->id);
        $task = $this->task->create([
            'name' => $data['name'],
            'content' => $data['content'],
            'user_id' => $data['user_id'],
            'calendar_id' => $calendar->id,
            'tag_id' => $tag_id,
        ]);
        
        return redirect()->route('task.store', ['id' => Auth::user()->id]);
    }

    public function edit($id) {
        $user_id = Auth::id();

        $task = Task::where('id', $id)->where('user_id', $user_id)->first();
        $timer = Timer::where('id', $task['timer_id'])->first();
        $event = Calendar::where('id', $task['calendar_id'])->first();
        return view('tasks.edit', ['task' => $task, 'timer' => $timer, 'event' => $event]);
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
        Calendar::where('id', $data['calendar_id'])->update(['start_date' => $data['start_date'], 'end_date' => $data['end_date']]);
        return redirect()->route('task.edit', ['id' => $id]);
    }
}
