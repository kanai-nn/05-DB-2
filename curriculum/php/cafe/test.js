const jump = document.querySelector(".jump");

window.addEventListener("scroll", function () {
  const scroll = window.pageYOffset;
  if (scroll > 500) {
    jump.style.opacity = "1";
    // jump.style.animationName = 'slide-top';
  } else {
    jump.style.opacity = "0";
  }
});

jump.addEventListener("click", scroll_top);
  
function scroll_top(){
  window.scroll({ top: 0, behavior:"smooth" });
  console.log("a");
};



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



const sp_signin =  document.querySelector(".sp_signin");
sp_signin.addEventListener("click", () => {
  if (openmodal.style.display === 'none') {
    openmodal.style.display = 'block'; // 要素を表示する
  } else {
    openmodal.style.display = 'none'; // 要素を非表示にする
  }
});


const sp = document.querySelector(".sp");
const sp_nav = document.querySelector(".sp_nav");
sp.addEventListener("click", () => {

  if (sp_nav.style.display === 'none') {
    sp_nav.style.display = 'block'; // 要素を表示する
  } else {
    sp_nav.style.display = 'none'; // 要素を非表示にする
  }
});

// document.addEventListener('click', (e) => {
//   if(!e.target.closest('.sp_nav')) {
    // クリックした要素の親要素にsp_navがなくて、displayがブロックならイベントを発火したい
//     if(sp_nav.style.display === 'block') {
//       sp_nav.style.display = 'none';
//     }
//   } 
// });


const _click3 =  document.querySelector("._click3");
const _click4 =  document.querySelector("._click4");

_click3.addEventListener("click", scroll_click1);
  


_click4.addEventListener("click", scroll_click2);
  
//アラートが画面に表示されている間は navは最初の位置・されていないときはtop:0;とかで一番上へ


var wh = window.innerHeight,
elements = document.querySelectorAll('.view-target');
    
elements = Array.prototype.slice.call(elements, 0);
 
window.addEventListener('load', update_window_size);
window.addEventListener('resize', update_window_size);
function update_window_size() {
  wh = window.innerHeight;
}
 
check_view();
window.addEventListener('load', check_view);
window.addEventListener('resize', check_view);
window.addEventListener('scroll', check_view, { passive: true });
 
function check_view(){
  elements.forEach(function ($element, i) {
    var eh = $element.offsetHeight,
    nowpos = $element.getBoundingClientRect().top - eh;
    let navc = document.querySelector('.navc');
    if(nowpos <= 0 && nowpos >= eh*-2){
      //見えてる時の処理をここに記述

      // navc.classList.add('active');
      navc.classList.remove('nonea');

    }else{
      //見えてない時の処理をここに記述

      navc.classList.add('nonea');
      // navc.classList.remove('active');
    }
  });
}