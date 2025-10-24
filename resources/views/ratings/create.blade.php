@extends('layouts.app')

@section('content')
<h1>Input Rating</h1>
<form action="{{ route('ratings.store') }}" method="POST" id="rating-form">
  @csrf
  <div class="mb-3">
    <label for="author_id" class="form-label">Author</label>
    <select id="author_id" name="author_id" class="form-control" required>
      <option value="">-- choose author --</option>
      @foreach($authors as $author)
        <option value="{{ $author->id }}">{{ $author->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="book_id" class="form-label">Book (from selected author)</label>
    <select id="book_id" name="book_id" class="form-control" required>
      <option value="">-- choose book --</option>
    </select>
  </div>

  <div class="mb-3">
    <label for="score" class="form-label">Rating (1–10)</label>
    <select id="score" name="score" class="form-control" required>
      @foreach(range(1,10) as $s)
        <option value="{{ $s }}">{{ $s }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label for="voter_name" class="form-label">Your Name (optional)</label>
    <input type="text" id="voter_name" name="voter_name" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Submit Rating</button>
</form>
@endsection

@push('scripts')
<script>
$(function(){
  $('#author_id').on('change', function(){
    var authorId = $(this).val();
    $('#book_id').html('<option>Loading...</option>');
    if (!authorId) {
      $('#book_id').html('<option value="">-- choose book --</option>');
      return;
    }
    $.getJSON('/authors/' + authorId + '/books', function(data){
      var html = '<option value="">-- choose book --</option>';
      if (data.length === 0) html = '<option value="">No books for this author</option>';
      $.each(data, function(i,book){
        html += '<option value="' + book.id + '">' + book.title + '</option>';
      });
      $('#book_id').html(html);
    }).fail(function(){
      $('#book_id').html('<option value="">Error loading books</option>');
    });
  });
});
</script>
@endpush
