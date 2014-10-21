/**
 * Created by peter on 13.01.14.
 */

$(document).ready(function () {
    $('.selectBox').selectBox();

    $('.slider').bxSlider({
        slideWidth: 120,
        infiniteLoop: false,
        minSlides: 2,
        maxSlides: 5,
        moveSlides: 1,
        slideMargin: 10,
        pager: false
    });
    if ($('#reset-password-modal').length)
        $('#reset-password-modal').arcticmodal({closeOnOverlayClick: true});
    if ($('#login-modal').length)
        $('#login-modal').arcticmodal({closeOnOverlayClick: true});
    if ($('#registration-modal').length)
        $('#registration-modal').arcticmodal({closeOnOverlayClick: true});
    if ($('div.tabs').length) {
        var tabs = $('div.tabs');
        tabs.find('ul').find('li:first-child').addClass('ui-state-active');
        var id = tabs.find('ul li.ui-state-active a').data('id');
        var height = 0;
        tabs.find('>div:not(#'+id+')').css({visibility: 'hidden', 'position': 'absolute', 'left': '-9000px'});
        $(document).on('click', 'div.tabs>ul>li>a', function (e) {
            e.preventDefault();
            $(this).parent().addClass('ui-state-active').parent().parent().find('li').not($(this).parent()).removeClass('ui-state-active');
            var id = $(this).data('id');
            var tabs = $(this).closest('div.tabs');
            tabs.find('>div').not('#'+id).css({visibility: 'hidden', 'position': 'absolute', 'left': '-9000px'});
            tabs.find('#'+id).css({visibility: 'visible', 'position': 'static'});
        });
    }

    if ($("a.fancybox").length)
        $("a.fancybox").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	600,
            'speedOut'		:	200,
            'overlayShow'	:	true,
            'titleShow'     :   false,
            'titlePosition': 'over'
    });

    $(document).on('click', 'div.one-lesson a.show-lesson-words', function (e) {
        e.preventDefault();
        if ($('#words-phrases-modal').length)
            $('#words-phrases-modal').arcticmodal({closeOnOverlayClick: true});
    });

    $(document).on('click', 'a.change-photo-link', function (e) {
        e.preventDefault();
        $(this).closest('div').find('input[type=file]').click();
    });
});
