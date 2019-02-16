$(document).ready(function(){

    //липкий хедер

    if($(this).scrollTop()>120){
        $('.header').addClass('header-fixed');
    }

    var scrollPos = 0;
    $(window).scroll(function(){
        var st = $(this).scrollTop();
        if (st > scrollPos){
            $('.header').addClass('header-fixed');
        } else {
            if($(this).scrollTop()<=100)
            $('.header').removeClass('header-fixed');

        }
        scrollPos = st;
    });

    $('#header-title').hover(function(){
        $('#header-title path').toggleClass('onHoverStr');
        $('#header-title rect').toggleClass('onHover');
        $('#header-title path').css('stroke','0');
    })

    //user menu
    var CursorAbove = false;
    $('.btn-open').click(function(e){
        var pos = $('.pos-out').position();
        $(this).toggleClass('clicked');
        $('.user-menu').toggleClass('toggle-display').css('top', pos.top + 41).css('left', pos.left);
    });
    $(window).scroll(function(){
        $('.user-menu').removeClass('toggle-display');
        $('.btn-open').removeClass('clicked');
    });

    //футер
    if($('body').height()<$(window).height()){
        $('#footer').addClass('sticky-footer');
    }
    else{
        $('#footer').removeClass('sticky-footer');
    }

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
        $('#login-wrap').fadeOut('300');
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
