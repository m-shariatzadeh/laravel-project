<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SlidersController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post/{id}', function ($id) {
    return "post id is: $id";
});

//redirect
Route::redirect('/admin/login','/');

//group
Route::prefix('user')->group(function (){
    Route::get('/register', function () {
        return "this is register page";
    });
    Route::get('/login', function () {
        return "this is login page";
    });
});

Route::get('/phpinfo', function () {
    return phpinfo();
});

//Route::get('/posts/{id?}', [PostsController::class,'index']);

Route::resource('/slider',SlidersController::class);

Route::get('/insert',[PostsController::class,'insert']);

Route::get('select',[PostsController::class,'select']);

Route::get('update',[PostsController::class,'updatePost']);

Route::get('delete',[PostsController::class,'deletePost']);

Route::get('getposts',[PostsController::class,'getPosts']);

Route::get('newpost',[PostsController::class,'newPost']);

Route::get('postupdate',[PostsController::class,'postUpdate']);

Route::get('postdelete',[PostsController::class,'postDelete']);

Route::get('trash',[PostsController::class,'getTrashed']);

Route::get('restore',[PostsController::class,'restorePost']);

Route::get('forceDeletePost',[PostsController::class,'forceDeletePost']);

Route::get('userFake',[PostsController::class,'userFake']);


Route::get('userposts',function (){

    // one to one
//    $user_post = \App\Models\User::findOrFail(1)->post;
//    $user_post = \App\Models\Post::findOrFail(1)->user;
//    return $user_post;

    //one to many
//    $user_posts = \App\Models\User::find(1)->posts;
//    return $user_posts;

    //many to many
    $user = \App\Models\User::findOrFail(1);

    foreach ($user->roles as $role){
        echo $role->name."<br>";
    }
});

//has many through
Route::get('/countryposts', function () {
    $posts = \App\Models\Country::find(1)->posts;

    foreach ($posts as $item)
    {
        echo $item->title.'<br>';
    }
});

//polymorphic / one to many
Route::get('polymorphic',function (){
//   $user = \App\Models\User::find(1);
//   foreach ($user->photos as $photo)
//   {
//       echo $photo->path.'<br>';
//   }

    $post = \App\Models\Post::find(1);
   foreach ($post->photos as $photo)
   {
       echo $photo->path.'<br>';
   }
});

//polymorphic / many to many
Route::get('/manytomany', function () {
    $post = \App\Models\Video::findOrFail(1);
//    dd($post->tags);
    foreach ($post->tags as $tag)
   {
       echo $tag->name.'<br>';
   }
});

//polymorphic / many to many /reverse
Route::get('/manytomany-video', function () {
    $tag = \App\Models\Tag::findOrFail(1);
//    dd($post->tags);
    foreach ($tag->videos as $video)
   {
       echo $video->name.'<br>';
   }
});

Route::get('/crud-create', function () {
    //one to many
//    $user = \App\Models\User::find(2);
//    $post = new \App\Models\Post();
//    $post->title = 'title post';
//    $post->body = 'this is tset';
////    $post->user_id = $user->id;
//    $user->posts()->save($post);

    //many to many
//    $user = \App\Models\User::find(1);
//    $role = new \App\Models\Role();
//    $role->name = 'نویسنده';
//    $user->roles()->save($role);

    //polymorphic / many to many
    $video = \App\Models\Video::find(1);
    $video->tags()->create(['name' => 'php']);
});

Route::get('/crud-read', function () {
//    $user = \App\Models\User::find(2);
//
//    foreach ($user->posts as $post)
//    {
//        echo $post->title.'<br>';
//    }

    //many to many
//    $user = \App\Models\User::find(1);
//
//    foreach ($user->roles as $role)
//    {
//        echo $role->name.'<br>';
//    }

//    polymorphic / many to many
    $video = \App\Models\Video::find(1);

    foreach ($video->tags as $tag)
    {
        echo $tag->name.'<br>';
    }

});

Route::get('/crud-update', function () {
//    $user = \App\Models\User::find(2);
//    $user->posts()->whereId(2)->update(['title'=>'updated this title']);
////    $user->name = 'joe';
////    $user->save();

    //many to many
//    $user = \App\Models\User::find(1);
//
//    if ($user->has('roles'))
//    {
//        foreach ($user->roles as $role)
//        {
//            if ($role->name == 'نویسنده')
//            {
//                $role->name = 'Author';
//                $role->save();
//            }
//        }
//    }

    //    polymorphic / many to many
    $video = \App\Models\Video::findOrFail(1);
    $tag = $video->tags;
    $newtag = $tag->where('id',3)->first()->update(['name' => 'web']);
//    dd($newtag);

});

Route::get('/crud-delete',function (){
//    $user = \App\Models\User::find(1);
//    $user->posts()->whereId(4)->delete();

    //many to many
//    $user = \App\Models\User::find(1);
//    foreach ($user->roles as $role)
//    {
//        if ($role->name == 'Author')
//        {
//            $role->delete();
//        }
//    }

    //    polymorphic / many to many
    $video = \App\Models\Video::find(1);
    $tag = $video->tags;
    $tag->where('id',8)->first()->delete();

});

Route::get('/atach', function () {
    $user = \App\Models\User::find(2);
    $user->roles()->attach([2]);
});

Route::get('/detach', function () {
    $user = \App\Models\User::find(2);
    $user->roles()->detach([1,2]);
});

Route::get('/sync', function () {
    $user = \App\Models\User::find(2);
    $user->roles()->sync([1]);
});

Route::resource('posts', PostController::class)->middleware(['auth']);

//files
Route::get('/file', function () {
//    return Storage::disk('public')->download('images/N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg');
//    return Storage::disk('public')->get('images/N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg');
//   $file =  Storage::disk('public')->url('images/N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg');
//   return "<img src='storage/images/N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg'>";

//     $file =  Storage::disk('files')->download('N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg');
//     return $file;
//    return "<a href='$file'>download</a>";
//    return Storage::disk('files')->url('N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg');
//    echo asset('storage/images/N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg');

//    Storage::disk('local')->put('file.txt', 'Contents');

//    Storage::put('avatars/1', 'fgdfgdgddf');
//    Storage::disk('files')->put('avatars/1', 'fgdfgdgddf');
//    return Storage::get('avatars/1');

//    return Storage::exists('avatars/1');
//    return Storage::disk()->missing('avatars/1');

//    return Storage::size('file.txt');
//    return Storage::lastModified('file.txt');

    // Automatically generate a unique ID for file name...
//    Storage::putFile('public', new File(storage_path('app/file.txt')));

    // Manually specify a file name...
//    Storage::putFileAs('public', new File(storage_path('app/file.txt')), 'test.txt');

//    Storage::prepend('file.txt', 'Prepended Text');
//    Storage::append('file.txt', 'Appended Text');

//    Storage::copy('file.txt', 'new/file.txt');
//    Storage::move('file.txt', 'new/file.txt');

//     return Storage::getVisibility('public/images/N4ZK9AmHXp7yHflJXcxlMlowgF22KGYXT5m0wyxo.jpg');

});


//download file protected
Route::get('fileProtected',[PostController::class,'fileProtected']);

Route::get('download/{file}',function ($file){
    // return Storage::disk('files')->download($file);
})->name('download');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', function () {
//    $user = Auth::user();
//    dd($user);
//    $check = Auth::check();
//    if ($check)
//    {
//        $user = Auth::user();
//        echo 'you are logged in: '.$user->name;
//    }
//    else
//    {
//        echo 'you are guest';
//    }

//    $user = Auth::attempt(['email'=>'shrytzadh@gmail.com','password'=>'123456789']);
    $user = \App\Models\User::findOrFail(5);
//    $login = Auth::login($user);
//    $logout = Auth::logout();
    $login = Auth::loginUsingId($user);
    return $login;

});

Route::get('/admin', function () {

    $user = Auth::user();

    echo 'you are Admin, welcome: '.$user->name;

})->middleware(['isAdmin'])->name('admin');

//Route::get('/admin', function () {
//
//    $user = Auth::user();
//
//    echo 'you are Admin, welcome: '.$user->name;
//
//})->middleware(['isAdmin:کاربر عادی'])->name('admin');

//session
Route::get('/session', function () {
//    return session()->all();
//    return session()->put(['username' => 'mostafa']);
//    return session()->get('username');
//    session()->flush();
//    session()->remove('username');
//    session()->flash('username','mostafa');
//    session()->reflash();
//    return session()->all();
});

