

<?php

// DBの接続定義
$dsn = 'mysql:host=mysql;dbname=cafe;charset=utf8mb4';
$username = 'root';
$password = 'root';

try {

	// PDOを作成
    $pdo = new PDO($dsn, $username, $password);

	// エラーモードの種類
	// PDO::ERRMODE_SILENT（エラーが発生しても何も表示しません）
	// PDO::ERRMODE_WARNING（エラーが発生時、PHPの警告メッセージとして表示されますが中断しない）
	// PDO::ERRMODE_EXCEPTION（エラーが発生時、処理の流れが中断し、例外をキャッチできる）
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // データベース操作　:value はパラメータ（プレースホルダー）。実際の値は後でバインドされる
    $stmt = $pdo->prepare("INSERT INTO contacts (name, kana, tel, email) VALUES (:name, :kana, :tel, :email)");

	$name = $_POST['name'];
	$kana = $_POST['kana'];
	$tel = $_POST['tel'];
	$email = $_POST['email'];


	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':kana', $kana);
	$stmt->bindParam(':tel', $tel);
	$stmt->bindParam(':email', $email);

    // データを挿入する
    $stmt->execute();
    
    echo 'データが正常に挿入されました。';

} catch (PDOException $e) {
    
	echo "接続失敗: " . $e->getMessage();

}

?>