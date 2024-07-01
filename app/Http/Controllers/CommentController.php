<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,comment')->only('edit', 'update');
        $this->middleware('can:delete,comment')->only('destroy');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('posts.show', $request->post_id);
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id);
    }

    public function destroy(Comment $comment)
    {
        $postId = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show', $postId);
    }
}
