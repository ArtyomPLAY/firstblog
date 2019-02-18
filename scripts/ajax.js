$(document).ready(function(){

    $('#login-popup form input[name="do_login"]').click(function(){
        var login = $('#login-popup input[name="login"]').val();
        var password = $('#login-popup input[name="password"]').val();
        $.ajax({
            url: "/php/auth/login.php",
            type: "POST",
            data: ({login: login, password: password}),
            dataType: "html",
            beforeSend:     function progress(){},
            success:     function funcSuccess(data){
                if(data == 'success'){
                    location.reload();
                }
                else
                    $('#login-popup form .passv-tip').html(data).show();
            }        
        });
        event.preventDefault();
        
    });

    $('.post .like').click(function(){
        $.ajax({
            url: "/php/auth/login.php",
            type: "POST",
            data: ({post_id: $(this).data('id')}),
            dataType: "html",
            beforeSend: function progress(){},
            success: function funcSuccess(data){
                if(data== 'liked' || data == "unliked"){
                location.reload();
            }
            }        
        });
    });




    /*$('#signup-popup input[type="submit"]').click(function(){
        if($(this).prev().css('display')=='block'){
            event.preventDefault();*/


});