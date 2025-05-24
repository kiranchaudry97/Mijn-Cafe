<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Alleen ingelogde gebruikers mogen deze controller gebruiken.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Sla een nieuwe reactie op voor een nieuwsbericht.
     */
    public function store(Request $request, News $news)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $news->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Reactie geplaatst.');
    }

    /**
     * Verwijder een reactie — alleen door eigenaar of admin.
     */
    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id && !auth()->user()?->is_admin) {
            abort(403, 'Je hebt geen rechten om deze reactie te verwijderen.');
        }

        $comment->delete();

        return back()->with('success', 'Reactie verwijderd.');
    }
}