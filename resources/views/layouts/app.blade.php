<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Bookstore Demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    nav[role="navigation"] {
        text-align: center;
        margin-top: 20px;
    }

    nav[role="navigation"] svg {
        width: 16px;
        height: 16px;
    }

    nav[role="navigation"] span[aria-hidden="true"] {
        display: none !important;
    }

    .pagination {
        justify-content: center;
        flex-wrap: wrap;
        gap: 4px;
    }

    .pagination .page-item {
        display: inline-block;
    }

    .pagination .page-link {
        min-width: 40px;
        height: 38px;
        line-height: 38px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        color: #007bff;
        background-color: #fff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
        text-decoration: none;
    }

    .pagination-summary,
    .dataTables_info,
    nav[role="navigation"] > div:first-child {
        display: none !important;
    }
</style>

</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('books.index') }}">Bookstore</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('authors.top') }}">Top Authors</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('ratings.create') }}">Input Rating</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
