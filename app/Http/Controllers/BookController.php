<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // per_page dropdown values from 10 to 100 step 10
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, range(10,100,10))) $perPage = 10;

        $search = $request->get('q');

        // Base query: join books->authors -> compute avg rating & vote count
        $booksQuery = Book::select('books.*', DB::raw('COALESCE(AVG(ratings.score),0) as avg_score'), DB::raw('COUNT(ratings.id) as votes'))
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->groupBy('books.id');

        if ($search) {
            $booksQuery->where(function($q) use ($search) {
                $q->where('books.title','like','%'.$search.'%')
                  ->orWhere('authors.name','like','%'.$search.'%');
            });
        }

        // order by avg_score desc then votes desc
        $books = $booksQuery->orderByDesc('avg_score')->orderByDesc('votes')
            ->paginate($perPage)
            ->appends($request->except('page'));

        // if first load and no search/per_page provided, ensure it shows top 10: we already order by avg, default perPage=10
        return view('books.index', compact('books','perPage','search'));
    }
}
