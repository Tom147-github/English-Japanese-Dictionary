<!DOCTYPE html>
<html>
<head>
    <title>English-Japanese Dictionary</title>
</head>
<body>
    <form action="{{ route('show.test.page') }}" method="get" id="test">
        @csrf
        <div>
        <h3>Tags available</h3>
        @foreach ($tags as $tag)
            <input type="checkbox" name="{{ $tag }}" id="{{ $tag }}" value="{{ $tag }}">
            <label for="{{ $tag }}">{{ $tag }}</label><br>
        @endforeach
        </div>
        ---------------------------------------<br>
        <div>
        <h3>Order</h3>
            <input type="radio" name="order" id="alphabetical" value="alphabetical" checked>
            <label for="alphabetical">Alphabetical</label><br>
            <input type="radio" name="order" id="random" value="random">
            <label for="random">Random</label><br>
        </div>
        ---------------------------------------<br>
        <div>
        <h3>Word count</h3>
            <input type="number" name="wordCount" id="wordCount">
            <label for="wordCount">words</label>
        </div>
        <button type="submit" style="margin: 30px 0 0 0;">Start</button>
    </form>

    <button type="reset" form="test" style="margin: 50px 0 0 0;">Reset</button>
 
    <form action="{{ route('show.welcome') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Back</button>
    </form>
</body>
</html>