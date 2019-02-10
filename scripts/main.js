$(document).ready(function(){

    $(window).scroll(function(){
        $header = $('.header');
        if($(this).scrollTop()>=160){
            $header.addClass('header-fixed');
        }
        else{
            $header.removeClass('header-fixed');
        }
    });

    //формы входа и реги
    $('#header-nav button').click(function(){
        $('#login-wrap').fadeIn('300');
        $('#login-popup').fadeIn('300');
        $('#login-popup form input').each(function(){
            $(this).removeAttr('readonly');
        })
    });



    $('.login-popup-close').click(function(){ 
        $(this).parent().fadeOut('300');
        $('#login-wrap').class.fadeOut('300');
    });

    $('.switch-tab').click(function(){
        if($(this).closest('#login-popup').get(0)){
            $(this).parent().parent().parent().fadeOut();
            $('#signup-popup').fadeIn();
            $('#signup-popup form input').each(function(){
                $(this).removeAttr('readonly');
            })
        }
        else{
           $(this).parent().parent().parent().fadeOut();
            $('#login-popup').fadeIn();
        }
    });
 
    //обработка ввода паролей
    $pass2 = $('#signup-popup input[name="password2"]');

    $('#signup-popup input[name^="password"]').keyup(function(){
        if($pass2.val() != $('#signup-popup input[name="password"]').val() && $('.passv-tip').css('display') != 'block'){
            $('.passv-tip').css('display','block');

        }
        else if($pass2.val() == $('#signup-popup input[name="password"]').val() && $('.passv-tip').css('display') == 'block'){
            $('.passv-tip').slideDown('500',function(){$(this).css('display','none')});
        }
    });

    $('#signup-popup input[type="submit"]').click(function(){
       if($(this).prev().css('display')=='block'){
           event.preventDefault();
       }
    });

    //пост форма

    $('.postwr').click(function(){
        $('#post-form').css('display','block');
    });

    $('#post-form button').click(function(){
        $('#post-form').css('display','none');
    });



}) //окончание главного эвента
