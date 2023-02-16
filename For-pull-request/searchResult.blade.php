<!DOCTYPE html>
<html>
<head>
    <title>English-Japanese Dictionary</title>
</head>
<body>
    <table border="1">
        <thead>
        <tr>
            <th>Word</th>
            <th>Meaning</th>
            <th>Tag</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($words as $word)
            <tr>
                <td>{{ $word->word }}</td>
                <td>{{ $word->meaning }}</td>
                <td>{{ $word->tag }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form action="{{ route('show.search.page') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Back</button>
    </form>
</body>
</html>