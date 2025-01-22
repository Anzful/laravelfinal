<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <!-- Optional: Include Bootstrap CSS for better styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Categories</h1>
        
        @if($categories->isEmpty())
            <p>No categories available.</p>
        @else
            <ul class="list-group">
                @foreach($categories as $category)
                    <li class="list-group-item">
                        <strong>{{ $category->name }}</strong>
                        @if($category->books->isNotEmpty())
                            <ul class="mt-2">
                                @foreach($category->books as $book)
                                    <li>{{ $book->title }} by {{ $book->author->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No books in this category.</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Optional: Include Bootstrap JS for interactive components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
