const signin =  document.querySelector(".signin");
const openmodal = document.querySelector(".open-modal");
signin.addEventListener("click", () => {
  if (openmodal.style.display === 'none') {
    openmodal.style.display = 'block'; // 要素を表示する
  } else {
    openmodal.style.display = 'none'; // 要素を非表示にする
  }
});

document.getElementById('overlay').addEventListener('click', function(event) {
  const signinBox = document.getElementById('signin_box');
  if (!signinBox.contains(event.target)) {
    // クリックがサインインボックスの外だった場合、モーダルを非表示にする
    openmodal.style.display = 'none';
  }
});

if(document.getElementById("error") != null) {
  alert("氏名は必須入力です。10文字以内でご入力ください。\nフリナガは必須入力です。10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");
}

const sp = document.querySelector(".sp");
const sp_nav = document.querySelector(".sp_nav");
sp.addEventListener("click", () => {

  if (sp_nav.style.display === 'none') {
    sp_nav.style.display = 'block'; // 要素を表示する
  } else {
    sp_nav.style.display = 'none'; // 要素を非表示にする
  }
});

const _click1 =  document.querySelector("._click1");
const _click2 =  document.querySelector("._click2");
const section =  document.querySelector(".section");
const bg_black =  document.querySelector(".bg_black");

_click1.addEventListener("click", scroll_click1);
  
function scroll_click1(){
  section.scrollIntoView({  
    behavior: 'smooth'  
  });
};

_click2.addEventListener("click", scroll_click2);
  
function scroll_click2(){
  bg_black.scrollIntoView({  
    behavior: 'smooth'  
  });
};



const sp_signin =  document.querySelector(".sp_signin");
sp_signin.addEventListener("click", () => {
  if (openmodal.style.display === 'none') {
    openmodal.style.display = 'block'; // 要素を表示する
  } else {
    openmodal.style.display = 'none'; // 要素を非表示にする
  }
});

