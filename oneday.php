<?php
session_start();
require('library.php');
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
	$id = $_SESSION['id'];
	$name = $_SESSION['name'];
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/webapp/oneday.css">
        <title>One Day</title>
    </head>
<body>
    <header>
            <h1 id="title">OneDay</h1>
        <?php if (!empty($name)): ?>
                <p>~<?php echo h($name); ?>さんのマイページ~</p>
                <div id="signup">
                <a href="/webapp/logout/logout.php"><button id="logout">ログアウト</button></a>
                </div>
        <?php endif; ?>
        <?php if (empty($name)): ?>
            <div id="signup">
                <a href="/webapp/login/login.php"><button id="login">ログイン</button></a>
                <a href="/webapp/register/register.php"><button id="sign">新規登録</button></a>
            </div>
        <?php endif; ?>
    </header>
    <div>
        <div id="container">
            <div id="img1">
                <img src="/webapp/img/window.png" alt="窓" id="window">
                <a href="/webapp/calendar/calendar.php"><img src="/webapp/img/calendar.png" alt="カレンダー" id="calendar" ></a>
                <img src="/webapp/img/light.png" alt="ライト" id="light">
                <img src="/webapp/img/clock.png" alt="時計" id="clock">
                <img src="/webapp/img/others1.png" alt="" id="wall1">
            </div>
            </div>
            <div id="img2">
                <img src="/webapp/img/leaf1.png" alt="" id="leaf1">
                <img src="/webapp/img/leaf2.png" alt="" id="leaf2">
                <a href="/webapp/diary/diary.php"><img src="/webapp/img/cloud.png" alt="" id="cloud"></a>
                <img src="/webapp/img/person2.png" alt="人" id="person2">
                <img src="/webapp/img/sofa1.png" id="sofa1">
                <img src="/webapp/img/person1.png" alt="人" id="person1">
                <img src="/webapp/img/tv.png" alt="テレビ" id="tv">
            </div>
        </div>
        <div id="reason">
            <p>私はなんとなく過ごしている日常をもっと豊かに、と思いこのアプリを開発しました。<br>
                忙しなく過ぎていく毎日の中で、１日を振り返る時間を作ってみてもいいかもしれません。<br>
                その日にあった嬉しかったことを記録してみてください。そしてカレンダーで確認してみましょう！<br>
                角度を変えて日常を見つめることで、よりあなたの世界は明るくなるでしょう。
            </p>
        </div>
    </div>
</body>
</html>