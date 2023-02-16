<!DOCTYPE html>
<html>
<head>
    <title>English-Japanese Dictionary</title>
</head>
<body>
    <form action="{{ route('edit.word') }}" method="post">
        @csrf
        <div>
            <label for="word">Word: {{ $wordToBeEdited->word }}</label><br>
            => <input type="text" name="word" id="word" value="{{ $wordToBeEdited->word }}">
        </div>
        <div style="margin: 5px 0 0 0;">
            <label for="meaning">Meaning: {{ $wordToBeEdited->meaning }}</label><br>
            => <input type="text" name="meaning" id="meaning">
        </div>
        <div style="margin: 5px 0 0 0;">
            <label for="tag">Tag: {{ $wordToBeEdited->tag }}</label><br>
            => <input type="text" name="tag" id="tag">
        </div>
        <button type="submit" style="margin: 30px 0 0 0;">Edit</button>
    </form>

    <form action="{{ route('delete.word') }}" method="get">
        <button type="submit" onclick="return confirm('Delete this word?')" name="wordToBeDeleted"
        value="{{ $wordToBeEdited->word }}" style="margin: 50px 0 0 0;">Delete</button>
    </form>

    <form action="{{ route('show.edit.page') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Back</button>
    </form>
</body>
</html>