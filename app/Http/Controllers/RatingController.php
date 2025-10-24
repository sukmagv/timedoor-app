<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create(Request $request)
    {
        $authors = Author::orderBy('name')->limit(1000)->get();

        // JSON request
        if ($request->expectsJson()) {
            return response()->json(['authors' => $authors]);
        }

        return view('ratings.create', compact('authors'));
    }

    public function booksByAuthor($authorId)
    {
        $books = Book::where('author_id',$authorId)
            ->select('id','title')
            ->orderBy('title')
            ->limit(1000)
            ->get();

        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'book_id' => 'required|exists:books,id',
            'score' => 'required|integer|between:1,10',
            'voter_name' => 'nullable|string|max:255',
        ]);

        $rating = Rating::create([
            'book_id' => $request->book_id,
            'score' => $request->score,
            'voter_name' => $request->voter_name,
        ]);

        // Response mode: JSON for API, redirect for web
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Rating submitted successfully.',
                'data' => $rating
            ]);
        }

        return redirect()->route('books.index')->with('success','Rating submitted.');
    }
}
