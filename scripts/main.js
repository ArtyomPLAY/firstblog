$(document).ready(function(){

    //хедер'
    $(document).scroll(function(){
        if($(this).scrollTop()>0){
            $('.navbar').addClass('nav-scrolled');
        }
        else
            $('.navbar').removeClass('nav-scrolled');
    });

    $('#header-title').hover(function(){
        $('#header-title path').toggleClass('onHoverStr');
        $('#header-title rect').toggleClass('onHover');
        $('#header-title path').css('stroke','0');
    })

    //футер
    if($('body').height()<$(window).height()){
        $('#footer').addClass('sticky-footer');
    }
    else{
        $('#footer').removeClass('sticky-footer');
    }

    //формы входа и реги
    $('.navbar .login').click(function(){
        $('#login-wrap').fadeIn('300');
        $('#login-popup').fadeIn('300');
        $('#login-popup form input').each(function(){
            $(this).removeAttr('readonly');
        })
    });

    $('#login-popup form input[name="login"]').change(function(){
        $('#login-popup form .passv-tip').css('display','none');
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
      
    // var text = $('text');
    // function styleString(styletag){   
    //     console.log(styletag); 
    //     if (text.selectionStart != undefined) {
    //         var startPos = text.selectionStart;
    //         var endPos = text.selectionEnd;
    //         var selectedText = text.value.substring(startPos, endPos)
    //         console.log(startPos+endPos+selectedText);
        
    //     if (selectedText) {
    //         var v = text.value.substring(0, startPos);
    //         v += '[b]' + selectedText + '[/b]';
    //         v += text.value.substring(endPos);
             
    //         text.value = v;
    //       }
    //     }
    // }

    // $('.post-form .btn').click(function(){
    //     window.getSelection().removeAllRanges();
    //     if($(this).hasClass('set-bold')){
    //         styleString("b");
    //     }

    // })

    $('.post-form textarea').focus(function(){
        $('.post-form .input-group,.row').removeClass('default');
        $('.post-form textarea').removeClass('textarea-default');
    });

    $(document).click(function(e){
        var form = $('.post-form');

        if(!form.is(e.target) && form.has(e.target).length === 0){
            $('.post-form .input-group, .row').addClass('default');
            $('.post-form textarea').addClass('textarea-default').parent().removeClass('default').parent().removeClass('default');
        }
    });
    

    //side bar

    $('.threads li a').click(function(){
        var idto = $(this).data('id');
        console.log(idto);
        $('html, body').animate({scrollTop: $('.post[data-id="'+idto+'"').offset().top-72},500);
    });

    $('.popular-opener').click(function(){
        $('.threads').toggleClass('opened');
        $('.popular-opener span').toggleClass('span-opened');
    });
   

    



}) //окончание главного эвента
