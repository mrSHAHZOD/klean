<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(REquest $request)
    {
    $commment = Comment::create([
        'body' => $request->body,
        'post_id' => $request->post_id,
        'user_id' =>1,
    ]);

    return redirect()->back();
}

}
