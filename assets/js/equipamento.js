var $ = require('jquery');

$( document ).ready(function() {

    $('.patrimonio input').attr('required',true);
    $('.descricaosempatrimonio').hide();

    $('#equipamento_naopatrimoniado').change(function(){
        if($(this).is(":checked")){
            $('.descricaosempatrimonio').show();
            $('.descricaosempatrimonio input').attr('required',true);
            $('.patrimonio').hide();
            $('.patrimonio input').attr('required',false);
        }
        else {
            $('.patrimonio').show();
            $('.patrimonio input').attr('required',true);
            $('.descricaosempatrimonio').hide();
            $('.descricaosempatrimonio input').attr('required',false);
        }
    });

    $('.ip').hide();
    /*
    console.log($('#fixar_ip').val.length);
    if ($('#fixar_ip').val.length == 0) {
        $('.ip').hide();
    }
    else {
        $('.ip').show();
    }
*/

    $('#fixar_ip').change(function(){
        if($(this).is(":checked")){
            $('.ip').show();
        }
        else {
            $('.ip').hide();
        }
    });

});
