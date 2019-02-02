function show(state) {
    var wrap =  document.getElementById('login-wrap');
    var popup = document.getElementById('login-popup');
    wrap.style.display = state;
    popup.style.display = state;
    console.log("displayed");
}
/*window.onload=function(){
var element = document.getElementById("topmenu");
firstcolor = window.getComputedStyle(element).backgroundColor;
console.log("Первый цвет:" + firstcolor + element);
}*/