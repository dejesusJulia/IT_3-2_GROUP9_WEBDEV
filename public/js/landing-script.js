AOS.init();

function resizeFunc(){

    var w = window.outerWidth;

    if(w <= 767){
        document.getElementById('illusOne').classList.remove('ml-auto');
    }else if(w >= 768){
        document.getElementById('illusOne').classList.add('ml-auto');
    }

}

