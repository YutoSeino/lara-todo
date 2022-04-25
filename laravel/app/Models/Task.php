<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'tag_id',
        'calendar_id',
        'content',
    ];

    public function myTask($user_id){
        $tag = request('tag');
        // タグがなければ、その人が持っているメモを全て取得
        if(empty($tag)){
            return $this::select('tasks.*')->where('user_id', $user_id)->get();      
        }else{
        // もしタグの指定があればタグで絞る ->wher(tagがクエリパラメーターで取得したものに一致)
          $tasks = $this::select('tasks.*')
              ->leftJoin('tags', 'tags.id', '=','tasks.tag_id')
              ->where('tags.name', $tag)
              ->where('tags.user_id', $user_id)
              ->where('tasks.user_id', $user_id)
              ->get();
          return $tasks;
        }
    }
}
