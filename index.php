<?php
// 0. SESSION開始！！
session_start();

// 1.  関数群の読み込み
require_once('funcs.php');

loginCheck();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ本登録</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header>
    <nav>
        <a href="select.php">データ一覧</a>
        <a href="login.php">書籍登録</a>
        <!-- <form class="logout-form" action="logout.php" method="post"> -->
        <!-- <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> -->
        <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
    </nav>
</header>

    <!-- Main[Start] -->
<main>
    <!-- <div class="container"> -->
    <!-- insert.phpで入力した内容が送られる -->
    <form method="POST" action="insert.php">
        <fieldset>
            <legend>おすすめレシピ本登録フォーム</legend>
            <label for="book_name">書籍名</label>
            <input type="text" id="book_name" name="book_name" required placeholder="山田 太郎">
            <label for="book_url">書籍URL</label>
            <input type="url" id="url" name="book_url" required placeholder="https://">
            <label for="book_comment">コメント</label>
            <textarea id="content" name="book_comment" rows="6" required placeholder="書籍の内容や感想などをご入力ください"></textarea>

            <input type="submit" value="登録する">
        </fieldset>
    </form>
</main>
<!-- Main[End] -->

</body>

</html>