<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Lesson sample site</title>
  <!-- <link rel="stylesheet" href="index.css"> -->
  <!-- <script src="test.js"></script> -->
</head>
<div class="alert view-target">
  <a href="#">新型コロナウイルスに対する取り組みの最新情報をご案内</a>
</div>
<body>
<div class="wrapper"> 
  

   
  <?php include 'inc/header.php'; ?>
  <div class="open-modal" style="display: none"><div id="overlay">
		<div id="signin_box" style="margin-top: 0px; opacity: 1;">
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
  
  <div class="section">
    <div class="cafe_intro" id="cafe_intro">
      <div class="box">
        <div class="info">
          <div class="photo">
            <img src="img/cafe1.jpg" alt="東京 カフェ">
          </div>
          <div class="access">
            <p class="area">東京</p>
            <p class="distance">車で15分</p>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="info">
          <div class="photo">
            <img src="img/cafe2.jpg" alt="東京 カフェ">
          </div>
          <div class="access">
            <p class="area">神奈川</p>
            <p class="distance">車で30分</p>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="info">
          <div class="photo">
            <img src="img/cafe3.jpg" alt="東京 カフェ">
          </div>
          <div class="access">
            <p class="area">愛知</p>
            <p class="distance">車で1時間</p>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="info">
          <div class="photo">
            <img src="img/cafe4.jpg" alt="東京 カフェ">
          </div>
          <div class="access">
            <p class="area">京都</p>
            <p class="distance">車で40分</p>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="info">
          <div class="photo">
            <img src="img/cafe5.jpg" alt="東京 カフェ">
          </div>
          <div class="access">
            <p class="area">岡山</p>
            <p class="distance">車で1.5時間</p>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="info">
          <div class="photo">
            <img src="img/cafe6.jpg" alt="東京 カフェ">
          </div>
          <div class="access">
            <p class="area">鹿児島</p>
            <p class="distance">車で50分</p>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="info">
          <div class="photo">
            <img src="img/cafe7.jpg" alt="東京 カフェ">
          </div>
          <div class="access">
            <p class="area">沖縄</p>
            <p class="distance">車で２時間</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <main>
    <section class="bg_white">
      <h2>好きなロケーションを選ぼう</h2>
      <div class="cafe_local">
        <div class="box">
          <div class="info">
            <div class="photo">
              <img src="img/intro1.jpg" alt="クラシック">
            </div>
            <div class="text">クラシック</div>
          </div>
        </div>

        <div class="box">
          <div class="info">
            <div class="photo">
              <img src="img/intro2.jpg" alt="バー">
            </div>
            <div class="text">バー</div>
          </div>
        </div>

        <div class="box">
          <div class="info">
            <div class="photo">
              <img src="img/intro3.jpg" alt="キャンプs">
            </div>
            <div class="text">キャンプ</div>
          </div>
        </div>

        <div class="box">
          <div class="info">
            <div class="photo">
              <img src="img/intro4.jpg" alt="リゾート">
            </div>
            <div class="text">リゾート</div>
          </div>
        </div>
      </div>
      <div class="goto">
        <div class="goto_text">
          <h3>Go To Eats</h3>
          <p>キャンペーンを利用して、全国で食事しよう。<br>
          いつもと違う景色に囲まれてカラダもココロもリフレッシュ。
          </p>
        </div>
        <img src="img/goto.jpg" style="width:100%;border-radius:16px;">
      </div>
    </div>
    </section>
    <section class="bg_black">
      <p class="cafetop" id="cafe_exp">カフェ作りを体験しよう</p>
      <p>お店のエキスパートが案内するユニークな体験（直接対面型またはオンライン）。</p>
      <div class="cafe_exp">
        <div class="box">
          <div class="info">
            <div class="photo"><img src="img/exp1.jpg" alt="ジョブ"></div>
            <div class="text">ジョブ体験</div>
            <p>カフェカウンターを体験しよう。</p>
          </div>
        </div>

        <div class="box">
          <div class="info">
            <div class="photo"><img src="img/exp2.jpg" alt="レシピ"></div>
            <div class="text">レシピ体験</div>
            <p>美味しいレシピを考えてみよう。</p>
          </div>
        </div>

        <div class="box">
          <div class="info">
            <div class="photo"><img src="img/exp3.jpg" alt="プロモーション"></div>
            <div class="text">プロモーション体験</div>
            <p>お店の宣伝を手伝ってみよう。</p>
          </div>
        </div>
      </div>
    </section>
    <section class="bg_white">
      <h2>全国のホストに仲間入りしよう</h2>
      <div class="cafe_host">
        <div class="box">
          <div class="info">
            <div class="photo">
              <img src="img/host1.jpg" alt="ビジネス">
            </div>
            <div class="text">ビジネス</div>
          </div>
        </div>

        <div class="box">
          <div class="info">
            <div class="photo">
              <img src="img/host2.jpg" alt="コミュニティ">
            </div>
            <div class="text">コミュニティ</div>
          </div>
        </div>

        <div class="box">
          <div class="info">
            <div class="photo">
              <img src="img/host3.jpg" alt="食べ歩き">
            </div>
            <div class="text">食べ歩き</div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include 'inc/footer.php'; ?>
  <div class="jump">Jump To Top</div>
</div>

<script src="test.js"></script>

</body>
<link rel="stylesheet" href="inex.css">
</html>





