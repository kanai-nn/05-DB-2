
<?php
  // データベースの接続情報
  $dsn ='mysql:host=mysql;dbname=cafe;charset=utf8mb4';
  $username = 'root';
  $password = 'root';

  try {
    $pdo = new PDO($dsn, $username, $password);

    // エラーモードを設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // URLのクエリパラメータからidを取得
    if (isset($_GET['id']) && isset($_GET['name'])) {

      // $id = $_GET['id'];
      // $name = $_GET['name'];
      // $kana = $_GET['kana'];
      // $tel = $_GET['tel'];
      // $email = $_GET['email'];
      // $body = $_GET['body'];
      // $created_at = $_GET['created_at'];

      
      // // SQL DELETEクエリの作成
      // $sql = "SELECT * FROM contacts WHERE id = ?";

      // // プリペアドステートメントを準備
      // $stmt = $pdo->prepare($sql);

      // // パラメータをバインドして実行
      // // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      // // $stmt->execute();

      // $stmt->execute([$id]);
      // $data = $stmt->fetch(PDO::FETCH_ASSOC);

      // echo "なか";


    }

  }catch (PDOException $e){
    echo "エラー";
  }

  // echo "そと";
  // echo "リクエストメソッド: " . $_SERVER['REQUEST_METHOD'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "s";
  
    $id = $_POST['id'];
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $body = $_POST['body'];
    
    // データベースを更新する
    $query = "UPDATE contacts SET name = ?, kana = ?, tel = ?, email = ?, body = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $kana, $tel, $email, $body, $id]);


    // 更新後のリダイレクト
    // header("Location: contact.php"); // 更新成功ページにリダイレクト
    echo "<a href='contact.php'>戻る</a>";
    exit();

  }
?>

<html>
  <body>

     <form method="post" action="update.php">
    
      <dl>
        <dt><label for="name">氏名</label></dt>
        <dd><input type="text" name="name" id="name" placeholder="山田太郎" value=""></dd>
        <dt><label for="kana">フリガナ</label></dt>
        <dd><input type="text" name="kana" id="kana" placeholder="ヤマダタロウ" value=""></dd>
        <dt><label for="tel">電話番号</label></dt>
        <dd><input type="text" name="tel" id="tel" placeholder="09012345678" value=""></dd>
        <dt><label for="email">メールアドレス</label></dt>
        <dd><input type="text" name="email" id="email" placeholder="test@test.co.jp" value=""></dd>
      </dl>
      <h3><label for="body">お問い合わせ内容をご記入ください</label></h3>
      <dl class="body">
        <dd><textarea name="body" id="body"></textarea></dd>
        <!-- <dd><button type="submit" class="fB" name="confirm">送　信</button></dd> -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>" />

        <input type="submit" name="confirm" value="送信" class="confirm" />
      </dl>

    </form>
  </body>
</html>