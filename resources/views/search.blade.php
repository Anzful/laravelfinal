<!DOCTYPE html>
<html>
<head>
    <title>Search Books by Category</title>
</head>
<body>
    <h1>Search Books by Category</h1>
    <form action="/search/books-by-category" method="GET">
        <label for="category_id">Category ID:</label>
        <input type="number" id="category_id" name="category_id" required>
        <button type="submit">Search</button>
    </form>

    @if(isset($books))
        <h2>Search Results:</h2>
        <ul>
            @forelse($books as $book)
                <li>{{ $book->title }} by {{ $book->author->name }}</li>
            @empty
                <li>No books found for this category.</li>
            @endforelse
        </ul>
    @endif
</body>
</html>
