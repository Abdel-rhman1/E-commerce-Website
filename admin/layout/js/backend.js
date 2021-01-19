$(function(){
    
    $('.toggle-info').click(function(){
        $(this).toggleClass('Selected').parent().next('.panel-body').fadeToggle(100);
        if($(this).hasClass('Selected')){
            $(this).html('<i class="fa fa-minus fa-lg"></i>');
        }else{
            $(this).html('<i class="fa fa-plus fa-lg"></i>');
        }
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
    $('.dropdown-menu > li > a').mouseenter(function(){
        $(this).css({
            paddingLeft:'30px',
        },1500);
    })
    $('.dropdown-menu > li > a').mouseleave(function(){
        $(this).css({
            paddingLeft:'15px',
        },1500);
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
    $('.cat h3').click(function(){
        $(this).next('.option-view').fadeOut();
    })
    $('.cat h3').dblclick(function(){
        $(this).next('.option-view').fadeIn();
    })
    $('.option span').click(function(){
        $(this).addClass('active').siblings('span').removeClass('active');
        if($(this).data('view')=='full'){
            $('.cat .option-view').fadeIn();
        }else{
            $('.cat .option-view').fadeOut();
        }
    })
    $('.child-class').hover(function(){
        $(this).find('.show-delete').fadeIn(600);
    },function(){
        $(this).find('.show-delete').fadeOut(600);
    })
});