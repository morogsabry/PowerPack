$(function() {
    'use strict';
    // Hide Placeholder On Form Focus
    $('.login-page h1 span').click(function() {
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.login-page form').hide();
        $('.' + $(this).data('class')).show();
    });
});

  