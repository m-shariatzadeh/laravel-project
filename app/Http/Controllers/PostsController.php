<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index($id = null)
    {
//        return view('posts.index')->with('id',$id);
//        return view('posts.index',['id'=>$id]);
        return view('posts.index',compact('id'));
    }

    public function insert()
    {
        DB::insert('INSERT INTO posts(title,body) VALUES(?,?)',['test','this is test']);
    }

    public function select()
    {
        return DB::select('SELECT * FROM posts');
    }

    public function updatePost()
    {
        return DB::update('UPDATE posts SET title=? WHERE id=?',['title updated',2]);
    }

    public function deletePost()
    {
        return DB::delete('DELETE FROM posts WHERE id=?',[2]);
    }

    public function getPosts()
    {
//        $posts = Post::all();
//        $posts = Post::find(3);
        $posts = Post::where('title','test')->orderBy('id')->take(1)->get();
        return $posts;
    }

    public function newPost()
    {
//        $post = new Post();
//
//        $post->title = 'this is test';
//        $post->body = 'this is body for this post';
//
//        $post->save();

        $post = Post::create([
            'title' => 'this is test ....',
            'body' => 'this is body'
        ]);
    }

    public function postUpdate()
    {
//        $post = Post::where('id',2)->update(['title'=>'this is test5555','active'=>1]);
        $post = Post::findOrFail(3);
        $post->title = 'this is title444444';
        $post->active = 1;
        $post->save();
        return $post;
    }

    public function postDelete()
    {
//        $post = Post::findOrFail(4)->delete();
        $post = Post::destroy(3);
        return $post;
    }

    public function getTrashed()
    {
//        $posts = Post::withTrashed()->get();
        $posts = Post::onlyTrashed()->get();
//        $posts = Post::withoutTrashed()->get();
        return $posts;
    }

    public function restorePost()
    {
        $posts = Post::onlyTrashed()->where('id',3)->restore();
        return $posts;
    }

    public function forceDeletePost(){
        $post = Post::onlyTrashed()->where('id',3)->forceDelete();
        return $post;
    }

    public function userFake()
    {
//        $user = User::factory()->count(5)->make();
//         $user = User::factory()->count(5)->make([
//             'name' => 'mostafa'
//         ]);
//        $user = User::factory()->count(5)->state([
//             'name' => 'mostafa'
//         ])->make();

//        $user = User::factory()->create();
//        $user = User::factory()->count(4)->create();
//        $user = User::factory()->count(2)->create([
//            'name' => 'mostafa'
//        ]);

        $user = User::factory()->count(4)->state(new Sequence(
            ['name' => 'hasan'],
            ['name' => 'ali'],
            ['name' => 'mostafa'],
            ['name' => 'naser']
        ))->create();

        return $user;
    }

}
