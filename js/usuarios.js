var table_usuario;
var url_base = "http://noroeste.localhost.net/";
var method;
var idUsuario;

$(document).ready(function() {
  	// Datatables
  	table_usuario = $('#usuario-table').DataTable({
        "processing": true,
  		"ajax": url_base + 'usuarios/listar',
  		"columnDefs": [
  			{"data" : "username","targets":[0]},
  			{"data" : "first_name","targets":[1]},
  			{"data" : "last_name","targets":[2]},
  			{"data" : "email","targets":[3]},
  			{"data" : "phone","targets":[4]},
            {
            "data" : "id",
            "targets" :[5],
            "orderable": false,
            "render" : function ( data, type, full, meta ) {
                var html = '<div class="accion-usuario">'
                html += '<button type="button" class="btn btn-primary" data-toggle="modal" onclick="editUsuario('+data+')"><i class="glyphicon glyphicon-pencil"></i>  Editar </button>';
                html += '<button type="button" class="btn btn-danger" data-toggle="modal" onclick="borrarUsuario('+data+')"><i class="glyphicon glyphicon-trash"></i>  Borrar </button></div>';
                return html;
                }
            }
  		]
  	});
});

function addUsuario()
{
    method = 'add';
    validarCodigo();
    $('#add-usuario-form')[0].reset();
    $.ajax({
        url: url_base + 'usuarios/agregar',
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#Grupo').html('<option value="-1" selected="selected">Seleccionar</option>');
            for (var i = 0; i < data.usuario_select.length ; i++) {
                $('#Grupo').append('<option value="'+data.usuario_select[i]['id']+'">'+data.usuario_select[i]['name']+'</option>');
            };
            $('#add-usuario-modal').modal('show');
            $('.modal-title').text('Agregar Usuario');
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    })
}
