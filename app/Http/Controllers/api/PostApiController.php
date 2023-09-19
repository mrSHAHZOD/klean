<?php

namespace App\Http\Controllers\api;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostApiController extends Controller
{

    public function index()
    {
        return Post::limit(10)->get();
    }

    public function store(Request $request)
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
        return response(['succeess'=> 'Post muvofaqiyatli yaratildi']);
    }

    public function show(Post $post)
    {
        // return $post;
        return new PostResource($post);

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
