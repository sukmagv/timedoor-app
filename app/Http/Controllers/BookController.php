<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, range(10,100,10))) $perPage = 10;

        $search = $request->get('q');

        $booksQuery = Book::select('books.*',
                DB::raw('COALESCE(AVG(ratings.score),0) as avg_score'),
                DB::raw('COUNT(ratings.id) as votes'))
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->groupBy('books.id');

        if ($search) {
            $booksQuery->where(function($q) use ($search) {
                $q->where('books.title','like','%'.$search.'%')
                  ->orWhere('authors.name','like','%'.$search.'%');
            });
        }

        $books = $booksQuery
            ->orderByDesc('avg_score')
            ->orderByDesc('votes')
            ->paginate($perPage)
            ->appends($request->except('page'));

        // Return JSON if request is API (Postman)
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $books
            ]);
        }

        // Default (Blade view)
        return view('books.index', compact('books','perPage','search'));
    }
}
