



  $('.slider').slick({
    dots:true,
    arrows:false,
    draggable:false
  });

$('.feedback_slider').slick({
    dots:true,
    arrows:false,
    draggable:false,
    dotsClass:'feedbackDots'
    

  });  

let feedbackDotsUl = document.getElementsByClassName('feedbackDots')[0];
let nextbtn = document.createElement('button');
nextbtn.innerHTML = '<i class="fas fa-angle-right"></i>';
nextbtn.classList.add('NextBtn');
nextbtn.onfocus= function(){
  this.blur();
}
nextbtn.onclick = function(){
  next();
};

feedbackDotsUl.appendChild(nextbtn);

let prevbtn = document.createElement('button');

prevbtn.innerHTML = '<i class="fas fa-angle-left"></i>';

prevbtn.classList.add('PrevBtn');

prevbtn.onfocus= function(){
  this.blur();
}

prevbtn.onclick = function(){
  prev();
};
feedbackDotsUl.insertBefore(prevbtn,feedbackDotsUl.firstChild);

let feedbackDots = feedbackDotsUl.children;

for (var i = 1; i < feedbackDotsUl.childElementCount-1; i++) {

  feedbackDots[i].children[0].classList.add('ellipse');
  feedbackDots[i].children[0].classList.add('ellipse'+(i-1));

}



var player = new Playerjs({id:"player", file:"./assets/video/video.mp4"});
player.api('api');
function learn_button(href){
	window.location.href = href;
}
function play(){
	anime({
  targets: '.watch',
  opacity: '0',

  easing: 'easeInOutQuad',
  duration: 300,

});
  $('.watch').hide();
  anime({
  targets: '#player',
  opacity: '1',

  easing: 'easeInOutQuad',
  duration: 300,

});
  //player.api('play');
  
}
function next(slider = '.feedback_slider'){
$(slider).slick('slickNext');
}
function prev(slider = '.feedback_slider'){
$(slider).slick('slickPrev');
}
function debug(){
console.log(this);
}
window.onclick = debug;