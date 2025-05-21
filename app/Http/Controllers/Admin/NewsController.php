<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Toon overzicht van nieuwsitems.
     */
    public function index()
    {
        $newsItems = News::latest()->paginate(10);
        return view('admin.news.index', compact('newsItems'));
    }

    /**
     * Formulier voor nieuw item.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Opslaan van een nieuw item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'image'        => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('news_images', 'public');
        }

        $validated['user_id'] = Auth::id();

        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Nieuws toegevoegd!');
    }

    /**
     * Bewerken van bestaand item.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Updaten van bestaand item.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'image'        => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                Storage::disk('public')->delete($news->image_path);
            }

            $validated['image_path'] = $request->file('image')->store('news_images', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Nieuws bijgewerkt!');
    }

    /**
     * Verwijder een nieuwsitem.
     */
    public function destroy(News $news)
    {
        if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Nieuws verwijderd!');
    }
}