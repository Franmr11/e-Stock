$(document).ready(function () {

    $('.toggle ').on('click', function(){
        ignorar = $('.prueba').prop('checked');
        $('.loading').css('display', 'block');
        window.location.replace(window.location.href + "/" + ignorar);
    });
});