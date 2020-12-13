$(document).ready(function () {
    nombreClase = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
    $('#'+nombreClase).addClass('activo');
});