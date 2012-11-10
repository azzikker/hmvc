$(document).ready(function() {
    $('.hove').click(function(e) {
        /*var winndow_scroll = $(window).scrollTop() - 20;
        var offset_top = $(e.target).offset().top;
        var toggle_top = offset_top - winndow_scroll;
        
        $('.toggle').css({"top":toggle_top+"px"});*/
        $(e.currentTarget).find('.toggle').slideDown('fast'); 
        $('.toggle').addClass('tuggle');
        $(e.currentTarget).find('.toggle').removeClass('tuggle');
        $('.tuggle').slideUp('fast'); 
    });
    $('#sidebar').mouseleave(function(e) {
        $(e.currentTarget).find('.toggle').slideUp('fast');
        $(e.currentTarget).find('.toggle').removeClass('tuggle');
    });               
});