
<?php
session_start();
require('../library.php');
if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
	$id = $_SESSION['id'];
	$name = $_SESSION['name'];
}
// テキストの初期化
$text = "";

// データベースへの接続処理
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "oneday";

$conn = new mysqli($servername, $username, $password, $dbname);

// 接続の確認
if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

// 日付とテキストを取得するSQLクエリ
$query = "select text,created from diary where name='$name' ORDER BY created DESC";
$result = $conn->query($query);


// 結果を取得する
if ($result->num_rows > 0) {
    // 最初のイベントを追加
    $row = $result->fetch_assoc();
    $events[] = array('text' => $row['text'], 'created' => $row['created']);

    // 残りのイベントを追加
    while ($row = $result->fetch_assoc()) {
        $events[] = array('text' => $row['text'], 'created' => $row['created']);
    }
} else {
    $text = "データがありません";
    $created = null;
    $events = array(); // 空の配列を設定
}
// var_dump($result);
// PHPでデータをJSON形式に変換
$jsonData = json_encode($events);

// JavaScriptファイルにデータを埋め込むコードを生成
$jsCode = "let events = $jsonData;";

// JavaScriptファイルにコードを追記（既存のコードがある場合は上書きする）
// $jsFilePath = 'calendar.js';
// file_put_contents($jsFilePath, $jsCode, FILE_APPEND);

// JavaScriptファイルにデータを埋め込むコードを生成
$jsCode = "events = " . json_encode($events) . ";";

if (!$result) {
    die("クエリの実行に失敗しました: " . $conn->error);
}

// データベース接続を閉じる
$conn->close();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/webapp/calendar/calendar.css">
    <title>カレンダー</title>
</head>
<body>
    <header>
        <h1 id="title">OneDay</h1>
        <a href="/webapp/oneday.php"><button id="home">ホーム</button></a>
    </header>

    <div class="wrapper">
        <!-- xxxx年xx月を表示 -->
        <h1 id="header"></h1>
        <!-- ボタンクリックで月移動 -->
        <div id="next-prev-button">
                <button id="prev" onclick="prev()">＜</button>
                <button id="next" onclick="next()">＞</button>
        </div>
        <!-- カレンダー -->
        <div id="calendar"></div>
    <script>
        events = <?php echo json_encode($events); ?>;
    </script>
    <script src="/webapp/calendar/calendar.js" data-events="<?php echo htmlspecialchars(json_encode($events), ENT_QUOTES, 'UTF-8'); ?>"></script>
</body>
</html>


