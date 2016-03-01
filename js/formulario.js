$(document).ready(function(){
    $('#conteudo .botaoregistro, #formulario .fechar').on('click', function(){
        $('#formulario').slideToggle('fast');
        $("#formulario .focus").focus();
    });
});
