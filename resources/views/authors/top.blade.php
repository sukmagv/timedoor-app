@extends('layouts.app')

@section('content')
<h1>Top 10 Authors (voters with rating > 5)</h1>
<table class="table">
  <thead><tr><th>#</th><th>Author</th><th>Voters (>5)</th></tr></thead>
  <tbody>
    @foreach($authors as $a)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $a->name }}</td>
        <td>{{ $a->votes }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
