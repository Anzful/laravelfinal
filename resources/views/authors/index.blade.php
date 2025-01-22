<!DOCTYPE html>
<html>
<head>
    <title>Authors</title>
</head>
<body>
    <h1>Authors</h1>
    <ul>
        @foreach($authors as $author)
            <li>
                {{ $author->name }}
                @if($author->books->isNotEmpty())
                    <ul>
                        @foreach($author->books as $book)
                            <li>{{ $book->title }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No books available for this author.</p>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
