<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 id ="score">0</h1>
                <button id="clickbtn" onclick="clickBtn()">+1</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <script>
        let tg = window.Telegram.WebApp;
    </script>
    <script>
        var score = 0;
        updating = 1;
        function clickBtn() {
        score = score + updating;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        }
        function update() {
        score = score - 100;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        if1();
        updating += 1;
        }
        function update1() {
        score = score - 150;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        if1();
        updating += 2;
        }
        function update2() {
        score = score - 250;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        if1();
        updating += 3;
        }
        function update3() {
        score = score - 500;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        if1();
        updating += 10;
        }
        function auto() {
        score = score - 10000;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        if1();
        setTimeout("plusauto()", 1000);
        }
        function if1 () {
        if (score < -100) {
            document.write("Вы проиграли, так-как вы превысили лимит кредита");
        }
        }
        function plusauto () {
        score += updating;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        setTimeout("auto1()", 1000);
        }
        function auto1 () {
        score += updating;
        setTimeout("plusauto()", 1000);
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        }
        function pashalka () {
        score += 10000;
        document.getElementsByTagName("h1")[0].firstChild.data = score + "$";
        }
        function reboot () {
        alert("Ваш уровень прокачки " + updating + ". Ваш баланс " + score + " .");
        }
    </script>
</body>
</html>