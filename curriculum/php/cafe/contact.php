<?php 
    
    
    session_start();
    $mode = 'input';
    $errmessage = array();
    if(isset($_POST['back']) && $_POST['back']) {
        $mode = 'input';
    }else if(isset($_POST['confirm']) && $_POST['confirm']) {

        if(!$_POST['name']) {
            $errmessage[] = "A";
        }else if(mb_strlen($_POST['name']) > 10) {
            $errmessage[] = "A";
        }
        $_SESSION['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);
      
        if(!$_POST['kana']) {
            $errmessage[] = "A";
        }else if(mb_strlen($_POST['kana']) > 10) {
            $errmessage[] = "A";
        }
        $_SESSION['kana'] = htmlspecialchars($_POST['kana'], ENT_QUOTES);

        if(!$_POST['tel']){
            if(!preg_match('/^[0-9]+$/',$_POST['tel'])) {
                $errmessage[] = "A";
            }
        }
        $_SESSION['tel'] = htmlspecialchars($_POST['tel'], ENT_QUOTES);

        if(!$_POST['email']){
            $errmessage[] = "A";
        }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errmessage[] = "A";
        } 
        $_SESSION['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);

        if(!$_POST['body']) {
            $errmessage[] = "A";
        }
        $formatted_ms = nl2br(htmlspecialchars($_POST['body'], ENT_QUOTES));
            // $j = preg_replace('<br />', '¥n', $formatted_ms);
            // $formatted_ms = nl2br($_POST['body']);
            
        
        $_SESSION['body'] = $formatted_ms;

        if($errmessage) {
            $mode = 'input';
        } else {
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            $mode = 'confirm';
        }

        // print_r($errmessage);

    }else if(isset($_POST['send']) && $_POST['send']) {
        if(!$_POST['token'] || !$_SESSION['token'] || !$_SESSION['email']){
            $errmessage[] = "A";
            $_SESSION = array();
            $mode = 'input';
        }else if($_POST['token'] != $_SESSION['token']) {
            $errmessage[] = "A";
            $_SESSION = array();
            $mode = 'input';
        }else {

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
                $stmt = $pdo->prepare("INSERT INTO contacts (name, kana, tel, email, body) VALUES (:name, :kana, :tel, :email, :body)");
                
            
                $name = $_SESSION['name'];
                $name = mb_convert_encoding($_SESSION['name'], 'UTF-8', 'auto'); 
                $kana = $_SESSION['kana'];
                $kana = mb_convert_encoding($_SESSION['kana'], 'UTF-8', 'auto'); 
                $tel = $_SESSION['tel'];
                $tel = mb_convert_encoding($_SESSION['tel'], 'UTF-8', 'auto'); 
                $email = $_SESSION['email'];
                $email = mb_convert_encoding($_SESSION['email'], 'UTF-8', 'auto'); 
                $body = $_SESSION['body'];
                $body = mb_convert_encoding($_SESSION['body'], 'UTF-8', 'auto'); 
            
            
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':kana', $kana);
                $stmt->bindParam(':tel', $tel);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':body', $body);
            
                // データを挿入する
                $stmt->execute();
            
            } catch (PDOException $e) {
                
                echo "接続失敗: " . $e->getMessage();
            
            }
            
            $mode = 'send';
            $_SESSION['name'] = "";
            $_SESSION['kana'] = "";
            $_SESSION['tel'] = "";
            $_SESSION['email'] = "";
            $_SESSION['body'] = "";
        }} else {
        $_SESSION['name'] = "";
        $_SESSION['kana'] = "";
        $_SESSION['tel'] = "";
        $_SESSION['email'] = "";
        $_SESSION['body'] = "";
    } 

    //  require_once('db_connect.php');

    

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Lesson sample site</title>
  <link rel="stylesheet" href="contact.css"> 
  
</head>
<body id="app">
    <header class="contact">
        <nav class="motion">
            <div class="logo"><a href="cafe.php"><img src="img/logo.png" alt="Cafe"></a></div>
            <div class="g_nav">
                <div class="menu"><a href="cafe.php#cafe_intro">はじめに</a></div>
                <div class="menu"><a href="cafe.php#cafe_exp">体験</a></div>
                <div class="menu"><a href="contact.php">お問い合わせ</a></div>
            </div>
            <div class="sign">
                <div class="signin _click">サインイン</div>
                <div class="sp _click"><img src="img/menu.png" alt="スマホメニュー"></div>
                <div class="sp_nav">
                    <div class="sp_signin _click">サインイン</div>
                    <div class="sp_menu _click1"><a href="cafe.php#cafe_intro">はじめに</a></div>
                    <div class="sp_menu _click2"><a href="cafe.php#cafe_exp">体験</a></div>
                    <div class="sp_menu"><a href="contact.php">お問い合わせ</a></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="open-modal" style="display: none;"><div id="overlay">
        <div id="signin_box">
            <h2>ログイン</h2>
            <form action="" method="post">
            <dl>
                <dd><input type="text" name="name" placeholder="メールアドレス"></dd>
                <dd><input type="password" name="pass" placeholder="パスワード"></dd>
                <dd><button type="submit">送　信</button></dd>
            </dl>
            <dl class="sns">
                <dd><button name="twitter"><img src="img/twitter.png"></button></dd>
                <dd><button name="facebook"><img src="img/fb.png"></button></dd>
                <dd><button name="google"><img src="img/google.png"></button></dd>
                <dd><button name="apple"><img src="img/apple.png"></button></dd>
            </dl>
            </form>
        </div>
    </div></div>

    <?php if($mode == 'input') { ?>

        <?php if(!empty($errmessage)) { ?>

                <section>
                    <div class="contact_box">
                        <h2>お問い合わせ</h2>
                        <form action="contact.php" method="post">
                            <h3>下記の項目をご記入の上送信ボタンを押してください</h3>
                            <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
                            <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
                            <p><span class="required">*</span>は必須項目となります。</p>
                            <dl>
                                <dt><label for="name">氏名</label><span class="required">*</span></dt>
                                <dd id="error">氏名は必須入力です。10文字以内でご入力ください。</dd>
                                <dd><input type="text" name="name" id="name" placeholder="山田太郎" value="<?php echo $_SESSION['name']?>"></dd>
                                <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
                                <dd id="error">フリナガは必須入力です。10文字以内でご入力ください。</dd>
                                <dd><input type="text" name="kana" id="kana" placeholder="ヤマダタロウ" value="<?php echo $_SESSION['kana']?>"></dd>
                                <dt><label for="tel">電話番号</label></dt>
                                <dd id="error">電話番号は0-9の数字のみでご入力ください。</dd>
                                <dd><input type="text" name="tel" id="tel" placeholder="09012345678" value="<?php echo $_SESSION['tel']?>"></dd>
                                <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
                                <dd id="error">メールアドレスは正しくご入力ください。</dd>
                                <dd><input type="text" name="email" id="email" placeholder="test@test.co.jp" value="<?php echo $_SESSION['email']?>"></dd>
                            </dl>
                            <h3><label for="body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3>
                            <dl class="body">
                                <dd id="error">お問い合わせ内容は必須入力です。</dd>
                                <dd><textarea name="body" id="body"><?php echo preg_replace("(<br />)", "", $_SESSION['body'])?></textarea></dd>
                                <!-- <dd><button type="submit" class="fB" name="confirm">送　信</button></dd> -->
                                <input type="submit" name="confirm" value="送信" class="confirm" />
                            </dl>
                        </form>
                        <?php
                            // データベースの接続情報
                            $dsn ='mysql:host=mysql;dbname=cafe;charset=utf8mb4';
                            $username = 'root';
                            $password = 'root';

                            try {
                                // PDOインスタンスを作成
                                $pdo = new PDO($dsn, $username, $password);
                                
                                // エラーモードを設定（例外を投げるようにする）
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                // SQLクエリを作成
                                $sql = 'SELECT * FROM contacts'; 
                                // 'users'テーブルの全データを取得
                                
                                // クエリを実行
                                $stmt = $pdo->query($sql);

                                // 結果をテーブルで表示
                                echo "<table border='1'>
                                        <tr>
                                            <th>システムID</th>
                                            <th>氏名</th>
                                            <th>フリガナ</th>
                                            <th>電話番号</th>
                                            <th>メールアドレス</th>
                                            <th>お問い合わせ内容</th>
                                            <th>送信日時</th>
                                            
                                        </tr>";
                                
                                // フェッチしてデータをテーブルに表示
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['kana'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['tel'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['body'] ?? '') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['created_at'] ?? '') . "</td>";
                                    
                                    //echo "<td>" ."<a href=update.php>更新</a>"."</td>";
                                    //echo "<td>" . "<a href=delete.php>削除</a>"."</td>";
    
                                    echo "<td><a href='update.php?id=" . $row['id'] . "'>更新</a></td>";
                                    echo "<td><a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"本当に削除しますか？\");'>削除</a></td>";

                                    echo "</tr>";
                                }
                                
                                echo "</table>";
                            } catch (PDOException $e) {
                                // エラーメッセージを表示
                                echo 'Connection failed: ' . $e->getMessage();
                            }
                        ?>
                    </div>
            </section>
        <?php } else { ?>
            <section>
                <div class="contact_box">
                    <h2>お問い合わせ</h2>
                    <form action="contact.php" method="post">
                        <h3>下記の項目をご記入の上送信ボタンを押してください</h3>
                        <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
                        <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
                        <p><span class="required">*</span>は必須項目となります。</p>
                        <dl>
                            <dt><label for="name">氏名</label><span class="required">*</span></dt>
                        
                            <dd><input type="text" name="name" id="name" placeholder="山田太郎" value="<?php echo $_SESSION['name']?>"></dd>
                            <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
                
                            <dd><input type="text" name="kana" id="kana" placeholder="ヤマダタロウ" value="<?php echo $_SESSION['kana']?>"></dd>
                            <dt><label for="tel">電話番号</label></dt>
                    
                            <dd><input type="text" name="tel" id="tel" placeholder="09012345678" value="<?php echo $_SESSION['tel']?>"></dd>
                            <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
                        
                            <dd><input type="text" name="email" id="email" placeholder="test@test.co.jp" value="<?php echo $_SESSION['email']?>"></dd>
                        </dl>
                        <h3><label for="body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3>
                        <dl class="body">
                    
                            <dd><textarea name="body" id="body"><?php echo preg_replace("(<br />)", "", $_SESSION['body'])?></textarea></dd>
                            <!-- <dd><button type="submit" class="fB" name="confirm">送　信</button></dd> -->
                            <input type="submit" name="confirm" value="送信" class="confirm" />
                        </dl>
                    </form>
                    <?php
                        // データベースの接続情報
                        $dsn ='mysql:host=mysql;dbname=cafe;charset=utf8mb4';
                        $username = 'root';
                        $password = 'root';

                        try {
                            // PDOインスタンスを作成
                            $pdo = new PDO($dsn, $username, $password);
                            
                            // エラーモードを設定（例外を投げるようにする）
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            // SQLクエリを作成
                            $sql = 'SELECT * FROM contacts'; 
                            // 'users'テーブルの全データを取得
                            
                            // クエリを実行
                            $stmt = $pdo->query($sql);

                            // 結果をテーブルで表示
                            echo "<table border='1'>
                                    <tr>
                                        <th>システムID</th>
                                        <th>氏名</th>
                                        <th>フリガナ</th>
                                        <th>電話番号</th>
                                        <th>メールアドレス</th>
                                        <th>お問い合わせ内容</th>
                                        <th>送信日時</th>
                                     
                                    </tr>";
                            
                            // フェッチしてデータをテーブルに表示
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($row['kana'] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($row['tel'] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($row['body'] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($row['created_at'] ?? '') . "</td>";
                                
                                //echo "<td>" ."<a href=update.php>更新</a>"."</td>";
                                //echo "<td>" . "<a href=delete.php>削除</a>"."</td>";

                                echo "<td><a href='update.php?id=" . $row['id'] ."&name=". $row['name'] ."&kana=". $row['kana'] ."&email=".$row['email'] ."&body=".$row['body'] ."&tel=".$row['tel'] ."&created_at=".$row['created_at'] ."'>更新</a></td>";
                                echo "<td><a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"本当に削除しますか？\");'>削除</a></td>";

                                echo "</tr>";
                            }
                            
                            echo "</table>";
                        } catch (PDOException $e) {
                            // エラーメッセージを表示
                            echo 'Connection failed: ' . $e->getMessage();
                        }
                    ?>
                </div>
            </section>
        <?php }  ?>


    <?php }else if($mode == 'confirm'){ ?>
        <section>
            <div class="contact_box">
                <h2>お問い合わせ</h2>
                <form action="contact.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                    <p>下記の項目をご確認の上送信ボタンを押してください</p>
                    <p>内容を訂正する場合は戻るを押してください。</p>
                    <dl>
                        <dt class="nextdt"><label for="name">氏名</label></dt>
                        <!-- <dd class="error">氏名は必須入力です。10文字以内でご入力ください。</dd> -->
                        <dd><?php echo $_SESSION['name']?> </dd>
                        <dt class="nextdt"><label for="kana">フリガナ</label></dt>
                        <!-- <dd class="error">フリナガは必須入力です。10文字以内でご入力ください。</dd> -->
                        <dd><?php echo $_SESSION['kana']?> </dd>
                        <dt class="nextdt"><label for="tel">電話番号</label></dt>
                        <!-- <dd class="error">電話番号は0-9の数字のみでご入力ください。</dd> -->
                        <dd><?php echo $_SESSION['tel']?> </dd>
                        <dt class="nextdt"><label for="email">メールアドレス</label></dt>
                        <!-- <dd class="error">メールアドレスは正しくご入力ください。</dd> -->
                        <dd><?php echo $_SESSION['email']?> </dd>
                    </dl>
                    <h4 class="nexth3"><label for="body">お問い合わせ内容</label></h3>
                    <dl class="body">
                        <!-- <dd class="error">お問い合わせ内容は必須入力です。</dd> -->
                        <dd><?php  echo $_SESSION['body'] ?></textarea></dd>
                        <div class="seba">
                            <!-- <dd class="sendB"><button type="submit" name="send">送　信</button></dd>
                            <dd class="backB"><button type="submit" name="back">戻　る</button></dd> -->
                            <dd class="sB" style="width: 100%;"><input type="submit" name="send" value="送 信" class="sendB" /></dd>
                            <dd class="bB" style="width: 100%;"><input type="submit" name="back" value="戻　る" class="backB" /></dd>
                        </div>
                    </dl>
                </form>
            </div>
        </section>
 
    <?php } else if($mode == "send") { ?>
        <section>
            <div class="contact_box">
                <form action="contact.php" method="post">
                <h2>お問い合わせ</h2>
                <p>お問い合わせ頂きありがとうございます。</p>
                <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
                <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
                <div class="backtop"><a href="cafe.php">トップへ戻る</a></div>
            </div>
        </section>

    <?php } else { ?>

    <?php } ?>

    <?php include 'inc/footer.php'; ?>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.11.5/vue.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
        // alert("氏名は必須入力です。10文字以内でご入力ください。\nフリガナは必須入力です。10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");   
    </script>

</body>
<script src="contact.js"></script>
</html>