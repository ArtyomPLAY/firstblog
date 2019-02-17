$(document).ready(function(){

    function funcSuccess(data){
        $('#login-popup form .passv-tip').html(data).show();


    }

    function progress(){

    }

    $('#login-popup form input[name="do_login"]').click(function(){
        var login = $('#login-popup input[name="login"]').val();
        var password = $('#login-popup input[name="password"]').val();
        $.ajax({
            url: "/php/auth/login.php",
            type: "POST",
            data: ({login: login, password: password}),
            dataType: "html",
            beforeSend: progress,
            success: funcSuccess
        });
        event.preventDefault();
        
    });

    /*$('#signup-popup input[type="submit"]').click(function(){
        if($(this).prev().css('display')=='block'){
            event.preventDefault();*/


});