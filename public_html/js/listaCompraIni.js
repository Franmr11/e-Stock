$(document).ready(function () {


    $('.cantidad').on('change',function() {

        $('.loading').css('display', 'block');

        cantidad = $('.cantidad ').val();

        producto_lista_id = $(this).attr('id');

        if(cantidad == 0){

            if(confirm("¿Desea eliminar el producto de la lista?")){

                window.location.replace(window.location.href + "/delete/" + producto_lista_id);

            }

        }

        else if(cantidad > 0){

            window.location.replace(window.location.href + "/new&compra_id=" + producto_lista_id + "&cantidad=" + cantidad);

        }

        $('.loading').css('display', 'none');

    });

  $('#dt-filter-select').dataTable({

    initComplete: function () {
      this.api().columns().every( function () {
          var column = this;
          var select = $('<select  class="browser-default custom-select form-control-sm"><option value="" selected>Search</option></select>')
              .appendTo( $(column.footer()).empty() )
              .on( 'change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                      $(this).val()
                  );

                  column
                      .search( val ? '^'+val+'$' : '', true, false )
                      .draw();
              } );

          column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
          } );
      } );
  }
  });
});