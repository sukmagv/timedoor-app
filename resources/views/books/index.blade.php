@extends('layouts.app')

@section('content')
<h1>Books</h1>

<form method="GET" class="row g-2 mb-3">
  <div class="col-md-4">
    <input type="text" name="q" class="form-control" placeholder="Search by book or author" value="{{ old('q',$search) }}">
  </div>
  <div class="col-md-2">
    <select name="per_page" class="form-control">
      @foreach(range(10,100,10) as $n)
        <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>{{ $n }} per page</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary">Search</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Reset</a>
  </div>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Author</th>
      <th>Category</th>
      <th>Avg Rating</th>
      <th>Voters</th>
    </tr>
  </thead>
  <tbody>
    @foreach($books as $book)
      <tr>
        <td>{{ $loop->iteration + ($books->currentPage()-1)*$books->perPage() }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author?->name }}</td>
        <td>{{ $book->category?->name }}</td>
        <td>{{ number_format($book->avg_score,2) }}</td>
        <td>{{ $book->votes }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $books->links() }}
@endsection
