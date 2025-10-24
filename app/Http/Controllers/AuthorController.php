<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function topTen()
    {
        $authors = DB::table('authors')
            ->select('authors.id','authors.name', DB::raw('COUNT(ratings.id) as votes'))
            ->join('books','books.author_id','authors.id')
            ->join('ratings','ratings.book_id','books.id')
            ->where('ratings.score','>',5)
            ->groupBy('authors.id')
            ->orderByDesc('votes')
            ->limit(10)
            ->get();

        return view('authors.top', compact('authors'));
    }
}
