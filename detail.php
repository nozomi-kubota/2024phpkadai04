<?php
// 1. SESSION開始、DB接続、ログインチェック
session_start();
require_once('funcs.php');
loginCheck();

//２．データ登録SQL作成
$pdo = db_conn();
$id = $_GET['id']; //?id~**を受け取る
$stmt = $pdo->prepare('SELECT * FROM gs_bookmark_table WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録内容編集</title>
    <link href="css/style.css" rel="stylesheet">
</head>


<nav class="navbar">
    <header>
        <!-- <nav> -->
        <a href="index.php">データ登録画面へ</a>
        <!-- </nav> -->
    </header>
</nav>


<body>
<div class="container">
    <header>
        <h1>登録内容の編集</h1>
    </header>
    <main>
        <div>
            <form method="post" action="update.php">
                <input type="hidden" name="id" value="<?= htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8') ?>">
                <label for="date">日付:</label>
                <input type="text" name="date" value="<?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?>"><br>
                <label for="book_name">書籍名:</label>
                <input type="text" name="book_name" value="<?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?>"><br>
                <label for="book_url">URL:</label>
                <input type="text" name="book_url" value="<?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?>"><br>
                <label for="book_comment">コメント:</label>
                <textarea name="book_comment"><?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?></textarea><br>
                <input type="submit" value="登録内容を更新">
            </form>
        </div>
    </main>
    <script src='js/script.js'></script>
    
</div>
</body>

</html>