$(function () {
//    $(window).on('beforeunload',function(){
//        return false;
//    });
   $(window).scroll(function(){
        var x= parseInt($(".caption").offset().top);
        var y = parseInt($(window).scrollTop());
        console.log(y >= x);
        if(y >= (x-200)){
            $('.desc').fadeIn(2000);   
        }
   });
   $("#search").keyup(function(){
       var val =  $(this).val();
        $.ajax({
            type : "POST",
            url  : "search.php",
            data : {value: val},
            success:function(data){
                $('#item').html(data);
            },
            error:function(){
                console.log("No data Matched");
            },

        });
    });
    $('#SetImage').click(function (){
        alert($("#Choice_Image")[0].files[0].name);
    })
    $('.hoverLink').hover(function () {
        //$('body').css('backgroundColor','red');
        $('.Hover').show();
    },function(){
        $('.Hover').hide();
    })
    $('.Hover').hover(function(){
        $('.Hover').show();
    },function(){
        $(this).hide(400);
    })
    window.addEventListener('beforeunload',function(e){
        alert("Hello Wolrd");
    })
    var NameError=true,
    MailError=true,
    PhoneError=true,
    MessageError=true;
    $('.ConName').blur(function(){
        if($(this).val().length < 1)
        {
            NameError=true;
            $(this).css('border','1px solid #d45656');
            $(this).parent().siblings('.ErrorMess').fadeIn(300);
        }else{
            NameError=false;
            $(this).css('border','1px solid rgb(86 154 212)');
            $(this).parent().siblings('ErrorMess').fadeOut(300);
        }
    })
    $('.top').click(function(){
        $('html,body').animate({scrollTop:0},700);
     
    })
    $('.ConMail').blur(function(){
        if($(this).val().length < 1)
        {
            MailError=true;
            $(this).css('border','1px solid #d45656');
            $(this).parent().siblings('.ErrorMess').fadeIn(300);
        }else{
            MailError=false;
            $(this).css('border','1px solid rgb(86 154 212)');
            $(this).parent().siblings('ErrorMess').fadeOut(300);
        }
    })
    $('.ConPhone').blur(function(){
        if($(this).val().length < 1)
        {
            PhoneError=true;
            $(this).css('border','1px solid #d45656');
            $(this).parent().siblings('.ErrorMess').fadeIn(300);
        }else{
            PhoneError=false;
            $(this).css('border','1px solid rgb(86 154 212)');
            $(this).parent().siblings('ErrorMess').fadeOut(300);
        }
    })
    $('.ConMessage').blur(function(){
        if($(this).val().length < 1)
        {
            MessageError=true;
            $(this).css('border','1px solid #d45656');
            $(this).parent().siblings('.ErrorMess').fadeIn(300);
        }else{
            MessageError=false;
            $(this).css('border','1px solid rgb(86 154 212)');
            $(this).parent().siblings('ErrorMess').fadeOut(300);
        }
    })
    $('.conform').submit(function(e){
        if(NameError===true || MailError===true || PhoneError===true ||MessageError===true)
        {
            e.preventDefault(); 
            $('.ConName,.ConMail,.ConPhone,.ConMessage').blur(); 
        }else{
            $('#chatting').show(200);
        }
    });
    $('.Item-box').hover(function(){
        $('.Item-box .Item-image').css({
        },300)
    });
    $(window).scroll(function(){
        if($(this).scrollTop() >=600){
            $("#scroll-top").show(600);
        }
    });
    $("#scroll-top").click(function(){
        $('#online-chatting').show(200);
    });
    $('.x').click(function(){
        $('#online-chatting').hide(200);
    });
    $('.menu').click(function(){
        $('.uppear-menu').fadeIn(400);
        $('.canvas-background').fadeIn(400);
        $('.exit').fadeIn(400);
        $('body').css('overflow','hidden');
    });
    $('.exit').click(function(){
        $('.uppear-menu').hide(400);
        $('.exit').fadeOut(200);
        $('body').css('overflow','scroll');
        $('.canvas-background').fadeOut(400);
    })
    var emailError=true,
        messageError=true;
     
     
    $('.clientEmail').blur(function(){
        if($(this).val().length<4){
            $(this).css('border','1px solid #d45656');
            emailError=true;
        }else{
            $(this).css('border','1px solid rgb(86 154 212)');
            emailError=false;
        }
    });
    $('.Message').blur(function(){
        if($(this).val().length<10){
            $(this).css('border','1px solid #d45656');
            messageError=true;
        }else{
            $(this).css('border','1px solid rgb(86 154 212)');
            messageError=false;
        }
    });
    $('.Contact-form').submit(function(e)
    {
        if(emailError===true || messageError===true)
        {
            e.preventDefault(); 
            $('.Message,.clientEmail').blur(); 
        }
    });
    $('.login-page h1 span').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        $('.login-page form').hide();
        $('.' +$(this).data('class')).fadeIn(100);
    })
    $("select").selectBoxIt({
        showEffect: "shake",        
        autoWidth:false,
        showFirstOption: false,
    });
    $('[placeholder]').focus(function(){
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });
    $('input').each(function(){
        if($(this).attr('required') === 'required'){
        }
    });
    $('.show-pass').hover(function(){
        $('.Password').attr('type','text');
    },function(){
        $('.Password').attr('type','password');
    });
    $('.confirm').click(function(){
        return confirm("Are you sure");
    });
    $('.live_name').keyup(function(){
        $('.live_preview .caption h3').text($(this).val());
    })
    $('.live_desc').keyup(function(){
        $('.live_preview .caption p').text($(this).val());
    })
    $('.live_price').keyup(function(){
        $('.live_preview .Price').text('$'+$(this).val());
    })
});