<?php
// 0. SESSION開始！！
session_start();

// 1. 関数群の読み込み⇒ ログインチェック処理
require_once('funcs.php');
loginCheck();

//   //ログイン状況を表示
//   if (isset($_SESSION['chk_ssid'])) {
//     // ログインしている
//     echo "ログイン中" ;
// } else {
//     // ログインしていない
//     echo "ログインしていません";
// }

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_bookmark_table');
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>レシピ本一覧表示</title>
    <link rel="stylesheet" href="css/reset.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<nav class="navbar">
    <header>
        <!-- <nav> -->
        <a href="index.php">データ登録画面へ</a>
        <!-- </nav> -->
    </header>
</nav>

<main>

    <div>
        <h1>おすすめレシピ本一覧</h1>
        <input type="text" id="search-input" placeholder="検索...">
        <table>
            <tr>
                <th>日付</th>
                <th>書籍名</th>
                <th>URL</th>
                <th>コメント</th>
                <th>操作</th>
            </tr>
            <!-- PHP でデータを取得し、以下の形式で表示する -->
            <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?> :
                    <td>❖<?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?>❖
                    <td><a href="<?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?></a></td>
                    <td><?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?>
                    <td>
                        <a href="detail.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8') ?>">編集</a>
                        <a href="delete.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8') ?>" onclick="return confirm('本当に削除しますか？')">削除</a>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
    </div>
</main>
<script src='js/script.js'></script>

</body>

</html>