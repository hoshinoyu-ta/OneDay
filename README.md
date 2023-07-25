# アプリ名：OneDay

![oneday-image](readme-img/oneday-image.png)
## 概要

日常に起こったことを記録していくアプリです。<br>

## 目指した課題解決
些細な嬉しかった、良かったことを記録していくことで、前向きな気持ちになれる手助けになればいいなと思い開発しました。

## 利用方法

新規登録を行い、利用を開始してもらいます。<br>
カレンダーをタップしたら、投稿の確認ができるようになっています。<br>
吹き出しをタップしたら、投稿できるようになっています。

## 実装予定の機能
トップページの画像をモノクロで採用し、投稿されるたびにトップページのモノクロ画像に色がついていく機能を実装予定です。

## セットアップ

### データベース

db作成
```SQL
CREATE DATABASE oneday;
```

テーブル:「diary」作成	
```SQL
    CREATE TABLE diary (
        id INT PRIMARY KEY,
        name VARCHAR(255),
        text TEXT,
        created TIMESTAMP
    );
```

テーブル:「members」作成	
```SQL
    CREATE TABLE members (
        id INT PRIMARY KEY,
        name VARCHAR(255),
        password VARCHAR(255),
        email VARCHAR(255),
        created TIMESTAMP
    );
```

## 使用技術

* HTML5
* CSS3
* JavaScript
* PHP
* MySQL
* Apache

## 機能一覧

* 新規登録
* ログイン
* 投稿
* 投稿確認

![register-image](readme-img/register-image.png)

![login-image](readme-img/login-image.png)

![diary-image](readme-img/diary-image.png)

![calendar-image](readme-img/calendar-image.png)

![about-image](readme-img/about-image.png)