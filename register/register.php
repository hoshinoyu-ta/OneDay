<?php
session_start();
if(isset($_GET['action'])&& $_GET['action']=== 'rewrite' && isset($_SESSION['form'])){
    $form = $_SESSION['form'];
}else{
    // 配列の初期化
    $form=[
        'name' =>'',
        'email'=>'',
        'password'=>'',
    ];
}
$error=[];
require('../library.php');
// フォームが送信された時
if($_SERVER['REQUEST_METHOD']==='POST'){
    $form['name']=filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
        if($form['name'] === ''){
            // エラーが起こったことだけを記録
            $error['name']='blank';
        }
    $form['email']=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        if($form['email'] === ''){
            // エラーが起こったことだけを記録
            $error['email']='blank';
        }
        $form['password']=filter_input(INPUT_POST,'password',FILTER_SANITIZE_EMAIL);
        if($form['password'] === ''){
            // エラーが起こったことだけを記録
            $error['password']='blank';
        }elseif (strlen($form['password']) <4 ){
            $error['password']='length';
        }
        // この時点でプログラムが終わる
        if(empty($error)){
            $_SESSION['form']=$form;
            header('Location:check.php');
            exit();
        }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../register/register.css">
    <title>新規登録</title>
</head>
<body>
    <header>
        <h1 id="title">OneDay</h1>
        <a href="../oneday.php"><button id="home">ホーム</button></a>
    </header>
        <h1>新規登録</h1>
        <form action="" method="post">
            <div>
                <img src="../img/user.png" alt="" id="user" >
            </div>
            <div id="text">
                <input type="text" name="name" placeholder="UserName" value="<?php echo h($form['name']);?>">
                    <?php if (isset($error['name']) && $error['name']==='blank'): ?>
                        <p class="error">*ユーザーネームを入力してください</p>
                    <?php endif; ?>
            </div>
            <div id="pwd">
                <input type="password" name="password" id="" placeholder="Passward" value="<?php echo h($form['password']);?>">
                    <?php if (isset($error['password']) && $error['password']==='blank'): ?>
                        <p class="error">*パスワードを入力してください</p>
                    <?php endif; ?>  
                    <?php if (isset($error['password']) && $error['password']==='length'): ?>  
                        <p class="error">*パスワードは5文字以上で入力してください</p>
                    <?php endif; ?> 
            </div>
            <div>
                <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo h($form['email']);?>">
                    <?php if (isset($error['email']) && $error['email']==='blank'): ?>
                        <p class="error">*メールアドレスを入力してください</p>
                    <?php endif; ?>
            </div>
            <div id="submit">
                <input type="submit" value="登録" id="submit-i">
            </div>
            <div></div>
            <div></div>
        </from>
</body>
</html>