<!DOCTYPE html>
<html>
<head>
    <title>English-Japanese Dictionary</title>

    <style>
        div {
            border: solid;
            width: 0 auto;
            height: 70px;
            font-size: 50px;
            text-align: center;
            padding: 60px;
        }
    </style>
</head>
<body>
    <div id="wordCard"></div>

    <button type="button" id="prevButton">Prev</button>
    <button type="button" id="nextButton">Next</button>

    <script>
        const wordCards = @json($wordCards);

        const wordCard = document.getElementById("wordCard");
        const prevButton = document.getElementById("prevButton");
        const nextButton = document.getElementById("nextButton");

        let index = 0;
        wordCard.innerHTML = wordCards[0];

        prevButton.addEventListener('click', ()=>{
            //indexが最小値のときは値を減少させない
            if (index !== 0)
                index--;

            wordCard.innerHTML = wordCards[index];
        });
        nextButton.addEventListener('click', ()=>{
            //indexが最大値のときは値を増加させない
            if (index !== wordCards.length - 1)
                index++;

            wordCard.innerHTML = wordCards[index];
        });
    </script>

    <form action="{{ route('show.test.settings.page') }}" method="get">
        @csrf
        <button type="submit" style="margin: 50px 0 0 0;">Stop</button>
    </form>
</body>
</html>