<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // get the current user
            $user = Auth::user();
             // インスタンス化
            $taskModel = new Task();
            $tasks = $taskModel->myTask( Auth::id() );
            
            // タグに取得
             $tagModel = new Tag();
             $tags = $tagModel->where('user_id', Auth::id())->get();
            
            $view->with('user', $user)->with('tasks', $tasks)->with('tags', $tags);
        });
    }
}
