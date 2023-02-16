<!DOCTYPE html>
<html>
<head>
    <title>English-Japanese Dictionary</title>
</head>
<body>
    <form action="{{ route('register.to.dictionary') }}" method="post">
        @csrf
        <div>
            <label for="word">Word:</label><br>
            <input type="text" name="word" id="word">
        </div>
        <div style="margin: 5px 0 0 0;">
            <label for="meaning">Meaning:</label><br>
            <input type="text" name="meaning" id="meaning">
        </div>
        <div style="margin: 5px 0 0 0;">
            <label for="tag">Tag:</label><br>
            <input type="text" name="tag" id="tag">
        </div>
        <button type="submit" style="margin: 30px 0 0 0;">Register</button>
    </form>

    <form action="{{ route('show.word.list') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">View</button>
    </form>

    <form action="{{ route('show.search.page') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Search</button>
    </form>

    <form action="{{ route('show.edit.page') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Edit</button>
    </form>

    <form action="{{ route('show.test.settings.page') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Test</button>
    </form>
</body>
</html>