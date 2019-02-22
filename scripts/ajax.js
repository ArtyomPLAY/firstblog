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
        var pos = $(this).position();
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
                    if($('.post[data-id="'+id+'"] .like').next('p').text()!=0)
                        $('.post[data-id="'+id+'"] .like').next('p').text(parseInt(likes) + 1);
                    else
                    $('.post[data-id="'+id+'"] .social-btn .like').parent().append('<p>'+'1'+'</p>')
                }
                else if(data == 2){

                    var likes = $('.post[data-id="'+id+'"] .like').next('p').text();
                    $('.post[data-id="'+id+'"] .like path').removeClass('liked');
                    if($('.post[data-id="'+id+'"] .like').next('p').text()>1)
                        $('.post[data-id="'+id+'"] .like').next('p').text(parseInt(likes) - 1);
                    else
                    $('.post[data-id="'+id+'"] .like').next('p').remove();
                }
                else{
                    $('.post[data-id="'+id+'"]').append('<span class="hint">'+data+'</span>');
                    $('.hint').css('top', pos.top -75).delay(4000).fadeOut(300);
                }
            }        
        });
    });


});