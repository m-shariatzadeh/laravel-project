<?php

namespace App\Http\Controllers;

use App\Events\PostViewEvent;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
//        $posts = Post::all();
        $posts = Post::with('user')->get();
        return view('posts.index',compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {

//        dd($request->all());

//        $this->validate($request,[
//            'caption'     => 'required|max:5',
//            'description' => 'required'
//        ],[
//            'caption.required'     => 'لطفا عنوان را وارد نمایید.',
//            'caption.max'          => 'عنوان باید حداکثر 5 کاراکتر وارد نمایید',
//            'description.required' => 'لطفا توضیحات را وارد نمایید'
//        ]);
//        $post = new Post();

//        if ($image = $request->file('image'))
        {
//            $img_name = time().$image->getClientOriginalName();
//            $img_name = $image->getClientOriginalName();
//            $image->store('public/images');
//            $image->move('images',$img_name);
//            $post->image = $img_name;
        }
//
//        $post->title = $request->caption;
//        $post->body = $request->description;
//        $post->user_id = 1;
//        $post->save();

//        $file = $request->file('image')->store('public/images');
//        $path = Storage::putFile('files', $request->file('image'));

//        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        event(new PostViewEvent($post));
        return view('posts.show',compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit',compact('post'));
//        $user = Auth::user();
//        $post = Post::findOrFail($id);
//
//        if ($user->can('update',$post))
//        {
//            return view('posts.edit',compact('post'));
//        }
//        else
//        {
//            return "شما به این قسمت دسترسی ندارید";
//        }

//        if (Gate::allows('edit-post',$post))
//        {
//            $post = Post::findOrFail($id);
//            return view('posts.edit',compact('post'));
//        }
//        else
//        {
//            return "شما به این قسمت دسترسی ندارید";
//        }

    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->caption;
        $post->body  = $request->description;
        $post->save();
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }

    public function fileProtected()
    {
        return view('files.fileProtected');
    }
}
