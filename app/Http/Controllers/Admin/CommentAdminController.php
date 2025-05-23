<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentAdminController extends Controller
{
    /**
     * Beperk toegang tot alleen admins.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user()?->is_admin) {
                abort(403, 'Toegang geweigerd');
            }
            return $next($request);
        });
    }

    /**
     * Toon alle reacties in het adminpaneel.
     */
    public function index()
    {
        $comments = Comment::with(['user', 'news'])->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Verwijder een specifieke reactie.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Reactie verwijderd.');
    }
}