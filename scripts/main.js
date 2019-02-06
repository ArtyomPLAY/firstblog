var current_popup;
window.onload=function(){
    current_popup = document.getElementById('login-popup');
}

function show(state) {
    var wrap =  document.getElementById('login-wrap');
    wrap.style.display = state;
    current_popup.style.display = state;
    console.log("displayed");
}

function switchTab(tab){
    current_popup = document.getElementById(tab);

    if(tab == 'signup-popup')
        var sec_popup = document.getElementById('login-popup');
    else
        var sec_popup = document.getElementById('signup-popup');

    current_popup.style.display = 'block';
    sec_popup.style.display = 'none';
}