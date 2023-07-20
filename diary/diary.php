<?php
session_start();
// $stmt->bind_result($id,$name);
session_regenerate_id();
// $_SESSION['id']=$id;
$name=$_SESSION['name'];


// db接続情報
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "oneday";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// フォームデータの処理
require('../library.php');
$form=[
    'text'=>''
];
$error=[];

// $name = $_POST["name"];
// $text = h($_POST["text"]);

// ボタン押された時
if ($_SERVER['REQUEST_METHOD']==='POST'){
    $form['text']=filter_input(INPUT_POST,'text',FILTER_SANITIZE_STRING);
    if($form['text']===''){
        $error['text']='blank';
    }else{
        $text = h($form['text']);
        $stmt = $conn->prepare("INSERT INTO diary (name, text) VALUES (?, ?)");

        // エラーメッセージを確認する
        if (!$stmt) {
            die("Error: " . $conn->error);
        }        
        $stmt->bind_param("ss", $name, $text);
        $stmt->execute();

        header('Location:../oneday.php');
            exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/webapp/diary/diary.css">
    <title>Diary</title>
</head>
<body>
    <header>
        <h1 id="title">OneDay</h1>
        <a href="/webapp/oneday.php"><button id="home">ホーム</button></a>
    </header>
        <h1>今日の記録</h1>
            <div id="textarea">
                <form action="" method="post">
                    <p>日付</p>
                    <textarea id="write" cols="50" rows="9" name="text"><?php echo h($form['text']); ?></textarea>
                    <?php if(isset($error['text']) && $error['text']==='blank'):?>
                    <p class="memo">一言でもいいので本日の記録をしてみてください！</p>
                <?php endif; ?>
                <div>
                    <input type="submit" value="登録" id="register" onclick="showConfirmation()">
                </div>
                </form>
            </div>
    <script src="/webapp/diary/diary.js"></script>
</body>
</html>