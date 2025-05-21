<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Toon alle FAQ-items (admin overzicht).
     */
    public function index()
    {
        $faqs = Faq::with('category')->latest()->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Toon formulier om een nieuw FAQ-item aan te maken.
     */
    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faqs.create', compact('categories'));
    }

    /**
     * Verwerk het opslaan van een nieuw FAQ-item.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question'        => 'required|string|max:255',
            'answer'          => 'required|string',
        ]);

        Faq::create($data);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ-item aangemaakt.');
    }

    /**
     * Toon formulier om een bestaand FAQ-item te bewerken.
     */
    public function edit(Faq $faq)
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faqs.edit', compact('faq', 'categories'));
    }

    /**
     * Verwerk het bijwerken van een FAQ-item.
     */
    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,id',
            'question'        => 'required|string|max:255',
            'answer'          => 'required|string',
        ]);

        $faq->update($data);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ-item bijgewerkt.');
    }

    /**
     * Verwijder een FAQ-item.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ-item verwijderd.');
    }
}