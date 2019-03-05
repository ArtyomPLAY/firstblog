$(document).ready(function(){

    //login

    $('#login-popup form input[name="do_login"]').click(function(){
        var login = $('#login-popup input[name="login"]').val();
        var password = $('#login-popup input[name="password"]').val();
        $.ajax({
            url: "/php/auth/login.php",
            type: "POST",
            data: ({login: login, password: password, log_in:1}),
            dataType: "html",
            beforeSend:     function progress(){},
            success:     function funcSuccess(data){
                if(data == 1){
                    location.reload();
                }
                else
                    $('#login-popup form .passv-tip').css('display','flex');
                    $('#login-popup form .passv-tip p').html(data);
            }        
        });
        event.preventDefault();
        
    });

    //sign up
    $('#signup-popup form input[name="do_signup"]').click(function(){
        console.log('sss');
        var login = $('#signup-popup input[name="login"]').val();
        var password = $('#signup-popup input[name="password"]').val();
        var email = $('#signup-popup input[name="email"]').val();
        if(login !=''){
            $.ajax({
                url: "/php/auth/login.php",
                type: "POST",
                data: ({login: login, password: password, email: email, sign_up:1}),
                dataType: "html",
                beforeSend:     function progress(){},
                success:     function funcSuccess(data){
                    if(data == 1){
                        location.reload();
                    }
                    else
                        $('#signup-popup form .passv-tip').css('display','flex');
                        $('#signup-popup form .passv-tip p').html(data);
                }        
            });
        }
        else{
            $('#signup-popup form .passv-tip').css('display','flex');
            $('#signup-popup form .passv-tip p').html('Enter data');
        }
            
        event.preventDefault();
        
    });

    //post actions

    $('.post .like').click(function(){
        var id = $(this).data('id');
        var pos = $(this).position();
        $.ajax({
            url: "/php/auth/login.php",
            type: "POST",
            data: ({post_id: $(this).data('id'), like: true}),
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

    $('.post-delete').click(function(){
        var post_id = $(this).data('id');
        $.ajax({
            url: "/php/components/post_form.php",
            type: "POST",
            data: ({post_id: post_id}),
            dataType: "html",
            beforeSend: function progress(){},
            success: function funcSuccess(data){
                    if(data==1){
                        $('.post[data-id='+post_id+']').removeClass('post').html('<div class="alert alert-success" style="cursor: pointer">Post has been deleted! :(</div>');
                    }
                    else{
                        console.log(data);
                    }
                }
        });
    });

    $('.repost-btn').click(function(){
        var id = $(this).data('id');
        $.ajax({
            url: "/php/auth/login.php",
            type: "POST",
            data: ({ post_id: $(this).data('id'), repost: true }),
            dataType: "html",
            beforeSend: function progress(){},
            success: function funcSuccess(data){
                if(data == 1){
                    var reposts = $('.post[data-id="'+id+'"] .repost').next('p').text();
                    console.log('rep')
                    $('.post[data-id="'+id+'"] .repost path').addClass('reposted');
                    if($('.post[data-id="'+id+'"] .repost').next('p').text()!=0)
                        $('.post[data-id="'+id+'"] .repost').next('p').text(parseInt(reposts) + 1);
                    else
                    $('.post[data-id="'+id+'"] .social-btn .repost').parent().append('<p>'+'1'+'</p>')
                }
                else if(data == 2){

                    var reposts = $('.post[data-id="'+id+'"] .repost').next('p').text();
                    $('.post[data-id="'+id+'"] .repost path').removeClass('reposted');
                    if($('.post[data-id="'+id+'"] .repost').next('p').text()>1)
                        $('.post[data-id="'+id+'"] .repost').next('p').text(parseInt(reposts) - 1);
                    else
                    $('.post[data-id="'+id+'"] .repost').next('p').remove();
                }
                else{
                    $('.post[data-id="'+id+'"]').append('<span class="hint">'+data+'</span>');
                    $('.hint').css('top', pos.top -75).delay(4000).fadeOut(300);
                }
            }        
        });
    });



    //post-form

    $('.post-form input[name="post_submit"]').click(function($event){

        event.preventDefault();
        var title_ = $('.post-form input[name="title"]').val();
        var content_ = $('.post-form textarea[name="content"]').val();
        var tags_ = $('.post-form input[name="tags"]').val();
        $.ajax({
            url: "/php/components/post_form.php",
            type: "POST",
            data: ({title: title_, content: content_, tags:tags_}),
            dataType: "html",
            beforeSend: function progress(){},
            success: function funcSuccess(data){
                
                $('.posts-container').prepend(data);
                $('.post-form input[name="title"], textarea[name="content"], input[name="tags"]').val('');
                $('.post-form .input-group, .row').addClass('default');
                $('.post-form textarea').addClass('textarea-default').parent().removeClass('default').parent().removeClass('default');
            }
        });
    });
});