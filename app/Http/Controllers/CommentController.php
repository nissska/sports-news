<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
class CommentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:delete comment', only: ['destroy'])
        ];
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('status', 'Comment deleted successfully!');
    }
}

