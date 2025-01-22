<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
</head>
<body>
    <h1>Welcome to the Library</h1>
    <ul>
        @foreach($books as $book)
            <li>{{ $book->title }} by {{ $book->author->name }}</li>
        @endforeach
    </ul>
</body>
</html>
