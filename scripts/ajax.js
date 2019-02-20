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
                if(data == 1){
                    location.reload();
                }
                else
                    $('#login-popup form .passv-tip').html(data).show();
            }        
        });
        event.preventDefault();
        
    });

    $('.post .like').click(function(){
        var id = $(this).data('id');
        $.ajax({
            url: "/php/auth/login.php",
            type: "POST",
            data: ({post_id: $(this).data('id')}),
            dataType: "html",
            beforeSend: function progress(){},
            success: function funcSuccess(data){
                if(data == 1){
                    var likes = $('.post[data-id="'+id+'"] .like').next('p').text();
                    $('.post[data-id="'+id+'"] .like path').addClass('liked');
                    $('.post[data-id="'+id+'"] .like').next('p').text(parseInt(likes) + 1);
                }
                if(data == 0){
                    var likes = $('.post[data-id="'+id+'"] .like').next('p').text();
                    $('.post[data-id="'+id+'"] .like path').removeClass('liked');
                    $('.post[data-id="'+id+'"] .like').next('p').text(parseInt(likes) - 1);
                }

            }        
        });
    });

    



    /*$('#signup-popup input[type="submit"]').click(function(){
        if($(this).prev().css('display')=='block'){
            event.preventDefault();*/


});