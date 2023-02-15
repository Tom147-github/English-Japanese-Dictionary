<!DOCTYPE html>
<html>
<head>
    <title>English-Japanese Dictionary</title>
</head>
<body>
    <form action="{{ route('search.for.words') }}" method="post" id="search">
        @csrf
        <h3>Tags available</h3>
        @foreach ($tags as $tag)
            <input type="checkbox" name="{{ $tag }}" id="{{ $tag }}" value="{{ $tag }}">
            <label for="{{ $tag }}">{{ $tag }}</label><br>
        @endforeach
        <label for="keyword">Keyword:</label>
        <input type="text" name="keyword_for_search" id="keyword">
        <button type="submit" style="margin: 30px 0 0 0;">Search</button>
    </form>

    <button type="reset" form="search" style="margin: 50px 0 0 0;">Reset</button>
    
    <form action="{{ route('show.welcome') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Back</button>
    </form>
</body>
</html>