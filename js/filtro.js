$(document).ready(function(){
    $('#select-filtro').on('change', function(){
        var selectValor = '#' + $(this).val();

        $('#pai').children('div').hide();
        $('#pai').children(selectValor).show();
    })
})