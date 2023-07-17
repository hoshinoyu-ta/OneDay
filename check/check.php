<?php
    session_start();
    require('../library.php');

    if(isset($_SESSION['form'])){
        $form=$_SESSION['form'];
    }else{
        header('Location:register.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $db=dbconnect();
        $stmt=$db->prepare('insert into members (name,password,email)VALUES(?,?,?)');

        if(!$stmt){
            die($db->error);
        }
        $password=password_hash($form['password'],PASSWORD_DEFAULT);
        $stmt->bind_param('sss',$form['name'],$password,$form['email']);
        $success=$stmt->execute();
        if(!$success){
            die($db->error);
        }
        unset($_SESSION['form']);
        header('Location:../oneday.php');
    }   
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/webapp/check/check.css">
    <title>確認画面</title>
</head>
<body>
    <header>
        <h1 id="title">OneDay</h1>
        <a href="/webapp/oneday.php"><button id="home">ホーム</button></a>
    </header>

    <div id="regi-content">
        <h1>登録情報</h1>
            <p>記入した内容を確認して、「登録する」ボタンをクリックしてください</p>
            <form action="" method="post">
				<dl>
					<dt>ユーザー名</dt>
					    <dd><?php echo h($form['name']); ?></dd>
					<dt>メール</dt>
					    <dd><?php echo h($form['email']); ?></dd>
					<dt>パスワード</dt>
					    <dd>【表示されません】</dd>
				</dl>
				<div id="btn"><a href="register.php?action=rewrite" id="rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" id="submit"/></div>
			</form>
    </div>
</body>
</html>