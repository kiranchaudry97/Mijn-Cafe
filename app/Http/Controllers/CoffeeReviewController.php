<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coffee;

class CoffeeReviewController extends Controller
{
    public function store(Request $request, Coffee $coffee)
    {
        $data = $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $coffee->reviews()->create([
            'content' => $data['content'],
            'rating' => $data['rating'] ?? null,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Review geplaatst.');
    }
}