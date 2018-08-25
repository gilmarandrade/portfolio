function resize() {
    windowHeight = $(window).innerHeight();
    $('#galery img').each(function() {
        margin = (windowHeight - $(this).height()) / 2;
        $(this).css("margin-top", margin + "px");
    });
}
function scroll() {
    if ($(document).scrollTop() > 60) {
        $('#header-fixed-box').addClass('small');
    } else {
        $('#header-fixed-box').removeClass();
    }
}
function openGalery() {
    $('body').addClass('galery-opened');
    $(window).resize();
    var group = "." + $(this).data('group');
    $('#galery').data('group', $(this).data('group'));

    $('#galery ' + group).first().addClass('active fadeInFromRight');
    $('.galery-arrow-left').addClass('disabled');
    if ($('#galery ' + group).first().next(group).length == 0) {
        $('.galery-arrow-right').addClass('disabled');
    }
}
function closeGalery() {
    $('body').removeClass('galery-opened');
    $('#galery figure').removeClass('active');
    $('#galery figure').removeClass('fadeInFromRight fadeOutFromRight fadeInFromLeft fadeOutFromLeft');
    $('#galery').data('group', "");
    $('.galery-arrow-left').removeClass('disabled');
    $('.galery-arrow-right').removeClass('disabled');
}
function nextGalery() {
    var group = "." + $('#galery').data('group');
    var current = $('#galery').find(group + '.active');
    var next = current.next(group);
    if (next.length != 0) {
        current.removeClass('active');
        $('#galery figure').removeClass('fadeInFromRight fadeOutFromRight fadeInFromLeft fadeOutFromLeft');
        next.addClass('active fadeInFromRight');
        current.addClass('fadeOutFromRight');
        if (next.next(group).length == 0) {
            $('.galery-arrow-right').addClass('disabled');
        }
        $('.galery-arrow-left').removeClass('disabled');
    }
}
function prevGalery() {
    var group = "." + $('#galery').data('group');
    var current = $('#galery').find(group + '.active');
    var next = current.prev(group);
    if (next.length != 0) {
        current.removeClass('active');
        $('#galery figure').removeClass('fadeInFromRight fadeOutFromRight fadeInFromLeft fadeOutFromLeft');
        next.addClass('active fadeInFromLeft');
        current.addClass('fadeOutFromLeft');
        if (next.prev(group).length == 0) {
            $('.galery-arrow-left').addClass('disabled');
        }
        $('.galery-arrow-right').removeClass('disabled');
    }
}
$(document).ready(function() {
    $('#select-category').click(function() {
        $('body').toggleClass('select-category-opened');
    });
    $('#curtain-select-category').click(function() {
        $('body').toggleClass('select-category-opened');
    });

    $(window).scroll(scroll);
    $(window).resize(resize);

    $('.image-preview').click(openGalery);
    $('#galery-close').click(closeGalery);

    $('#galery').click(function() {
        $('body').toggleClass('galery-hide-controls');
    });
    $('.galery-arrow-right').click(nextGalery);
    $('.galery-arrow-left').click(prevGalery);
});