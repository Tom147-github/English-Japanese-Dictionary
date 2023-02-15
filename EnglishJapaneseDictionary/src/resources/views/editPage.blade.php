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
                <td>
                <form action="{{ route('show.edit.form') }}" method="get">
                    @csrf
                    <button type="submit" name="wordToBeEdited" value="{{ $word->word }}">Edit</button>
                </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <form action="{{ route('show.welcome') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Back</button>
    </form>

    <form action="{{ route('reset.dictionary') }}" method="get">
        @csrf
        <button type="submit" onclick="return confirm('Reset dictionary?')"
        style="margin: 50px 0 0 0;">Reset</button>
    </form>
</body>
</html>