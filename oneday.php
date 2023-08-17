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
        <link rel="stylesheet" href="oneday.css">
        <link rel="icon" href="img/favicon.ico">
        <title>One Day</title>
    </head>
<body>
    <header>
            <h1 id="title">OneDay</h1>
        <?php if (!empty($name)): ?>
                <p>~<?php echo h($name); ?>さんのマイページ~</p>
                <div id="signup">
                <a href="logout/logout.php"><button id="logout">ログアウト</button></a>
                </div>
        <?php endif; ?>
        <?php if (empty($name)): ?>
            <div id="signup">
                <a href="login/login.php"><button id="login">ログイン</button></a>
                <a href="register/register.php"><button id="sign">新規登録</button></a>
            </div>
        <?php endif; ?>
    </header>
    <div>
        <div id="container">
            <div id="img1">
                <img src="img/window.png" alt="窓" id="window">
                <a href="calendar/calendar.php"><img src="img/calendar.png" alt="カレンダー" id="calendar" ></a>
                <img src="img/light.png" alt="ライト" id="light">
                <img src="img/clock.png" alt="時計" id="clock">
                <img src="img/others1.png" alt="" id="wall1">
            </div>
            <div id="img2">
                <img src="img/leaf1.png" alt="" id="leaf1">
                <img src="img/leaf2.png" alt="" id="leaf2">
                <a href="diary/diary.php"><img src="img/cloud.png" alt="" id="cloud"></a>
                <img src="img/person2.png" alt="人" id="person2">
                <img src="img/sofa1.png" id="sofa1">
                <img src="img/person1.png" alt="人" id="person1">
                <a href="about/about.html"><img src="img/tv.png" alt="テレビ" id="tv"></a>
            </div>
        </div>
    </div>
</body>
</html>