$(document).ready(function(){
    $('#menu .fechar').on('click', function(){
        $('#menu').animate({
            left: '-1000px',
            display: 'none'
        });
        $('#conteudo').stop().animate({
            left:'0',
            width: '93%'
        });
        $('#header .menu').css({display: 'inline-block'});
    });
    $("#header .menu").on('click',function(){
        $('#menu').css({
            display:'inline-block'
        }).animate({
            left: '0'
        });
        $('#conteudo').stop().animate({
            left:'14%',
            width: '80%'
        });
        $('#header .menu').css({display: 'none'});
    });
});