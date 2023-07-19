<?php
    session_start();
    require('../library.php');
    $error=[];
    $name='';
    $password='';

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        
        $name =filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
        $password =filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

        // ボタンが空だったら
        if ($name === '' || $password === '') {
            $error['login'] = 'blank';
        }else{
        // ログインチェック
        $db = dbconnect();
        // whereで検索
        $stmt = $db->prepare('select id, name, password from members where name=? limit 1');
        if (!$stmt) {
            die($db->error);
        }
        $stmt->bind_param('s', $name);
        $success = $stmt->execute();
        if (!$success) {
            die($db->error);
        }
        // 結果を受け取る
        $stmt->bind_result($id, $name, $hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            // ログイン成功
            // sessionIDを生成しなおす
            session_regenerate_id();
            // sessionに記録
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            header('Location:../oneday.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/webapp/login/login.css">
    <title>ログイン</title>
</head>
<body>
    <header>
        <h1 id="title">OneDay</h1>
        <a href="/webapp/oneday.php"><button id="home">ホーム</button></a>
    </header>
    <h1>ログイン</h1>
        <form action="" method="post">
                    <div>
                        <img src="/webapp/img/user.png" alt="" id="user" >
                    </div>
                    <div id="text">
                        <input type="text" name="name" value="<?php echo h($name); ?>" placeholder="UserName">
                    </div>
                    <div id="pwd">
                        <input type="password" name="password" id="" value="<?php echo h($password); ?>" placeholder="password">
                    </div>
                <?php if (isset($error['login']) && $error['login'] === 'blank'): ?>    
                    <p class="error">* ユーザー名とパスワードをご記入ください</p>
                <?php endif; ?>
                <?php if (isset($error['login']) && $error['login'] === 'failed'): ?>
                    <p class="error">* ログインに失敗しました。正しくご記入ください。</p> 
                <?php endif; ?>
                    <div id="submit">
                        <input type="submit" value="ログイン"  id="submit-i">
                    </div>
        </form>
</body>
</html>