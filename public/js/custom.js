var scrollBtn = document.querySelector('.scroll-to-top');


window.onscroll = function() {scrollFunction()};


function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
      scrollBtn.style.display = "block";
    } else {
      scrollBtn.style.display = "none";
    }
}

function backToTop(){
    document.documentElement.scrollTop = 0;
}

function showFile(e){
    var fileName = document.getElementById('form-img').files[0].name;
    document.getElementById('img-name').innerText = fileName;
}