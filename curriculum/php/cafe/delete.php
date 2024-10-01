<?php

// データベースの接続情報
$dsn = 'mysql:host=mysql;dbname=cafe;charset=utf8mb4';
$username = 'root';
$password = 'root';

try {

  // PDOインスタンスを作成
  $pdo = new PDO($dsn, $username, $password);

  // エラーモードを設定
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // URLのクエリパラメータからidを取得
  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // SQL DELETEクエリの作成
    $sql = 'DELETE FROM contacts WHERE id = :id';

    // プリペアドステートメントを準備
    $stmt = $pdo->prepare($sql);

    // パラメータをバインドして実行
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 削除が成功した場合のメッセージ
    echo "削除が完了しました。<br>";
    echo "<a href='contact.php'>戻る</a>";

    // 削除完了後に元のページ（例: index.php）にリダイレクトすることができる
    //header('Location: contact.php?res=OK');  // リスト表示ページのURLに変更

    //削除完了後にJavaScriptのalertでメッセージを表示して、OK後にリダイレクト
    // echo 
    // "<script>
    //   alert('削除が完了しました。');
    //   window.location.href = 'contact.php';  // リスト表示ページにリダイレクト
    // </script>
    // ";    
    // exit; 

  } else {

    echo "削除するIDが指定されていません。<br>";
    echo "<a href='contact.php'>戻る</a>";
  }
} catch (PDOException $e) {
  // エラーメッセージを表示
  echo 'Connection failed: ' . $e->getMessage();
}
?>