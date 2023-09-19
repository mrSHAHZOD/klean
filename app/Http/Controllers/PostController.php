<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Tag;
use App\Events\PostCreated;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Jobs\ChangePost;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailPostCreated;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostDeleted;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
      //   $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {/*
       $posts = Cache::remember('posts', now()->addSeconds(120), function () {
        return Post::latest()->get();
       });

       return view('posts.index')->with('posts', $posts );
 */
       return Post::limit(10)->get();
    }


    public function create()
    {

        return view('posts.create')->with([
            'categories'=> Category::all(),
            'tags' =>Tag::all(),
    ]);
    }


    public function store(StorePostRequest $request)
    {
        if($request->hasFile('photo')){
        $name = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('post-photos', $name);
        }

       $post = Post::create([
            'user_id'=> auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? null,
       ]);

       if(isset($request->tags)){
        foreach ($request->tags as $tag) {
            $post->tags()->attach($tag);
        }
    }

    PostCreated::dispatch($post);


    ChangePost::dispatch($post)->onQueue('uploading');

    Mail::to($request->user())->later(now()->addMilliseconds(15),(new MailPostCreated($post))/* ->onQueu('sending-mails') */);


    Notification::send(auth()->user(), new PostDeleted($post));

       return redirect()->route('posts.index')->with('status', 'succeess');
    }


    public function show(Post $post)
    {
        return view('posts.show')->with([
        'post' => $post,
        'recent_posts' =>Post::latest()->take(5)->get()->except($post->id)->take(5),
            'categories'=> Category::all(),
        'tags'=> Tag::all(),

    ]);
    }


    public function edit(Post $post)
    {

        // Gate::authorize('update', $post);


        return view('posts.edit')->with(['post'=> $post]);
    }


    public function update(StorePostRequest $request, Post $post)
    {
        //  Gate::authorize('update', $post);

        if($request->hasFile('photo')){
            if(isset($post->photo)){
                Storage::delete($post->photo);
            }
            $name = $request->file('photo')->getClientOriginalName();

            $path = $request->file('photo')->storeAs('post-photos', $name);
            }

        $post->update([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? $post->photo,
        ]);

        return redirect()->route('posts.show', ['post'=>$post->id]);
    }


    public function destroy(Post $post)
    {
        if(isset($post->photo)){
            Storage::delete($post->photo);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }


}
