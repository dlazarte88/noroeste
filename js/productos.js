var table_producto;
var url_base = "http://noroeste.localhost.net/";
var modal_option = {'backdrop':'static','keyboard':false,'show':true}
var method;
var idProducto;

$(document).ready(function() {
  	// Datatables
  	table_producto = $('#productos-table').DataTable({
        "processing": true,
  		"ajax": url_base + 'productos/listar',
  		"columnDefs": [
  			{"data" : "idProductos","targets":[0]},
  			{"data" : "Nombre","targets":[1]},
  			{"data" : "Codigo","targets":[2]},
  			{"data" : "Descripcion","targets":[3]},
  			{"data" : "Imagen","targets":[4]},
            {
            "data" : "idProductos",
            "targets" :[5],
            "orderable": false,
            "render" : function ( data, type, full, meta ) {
                var html = '<div class="accion-producto">'
                html += '<button type="button" class="btn btn-primary" data-toggle="modal" onclick="editProducto('+data+')"><i class="glyphicon glyphicon-pencil"></i>  Editar </button>';
                html += '<button type="button" class="btn btn-danger" data-toggle="modal" onclick="borrarProducto('+data+')"><i class="glyphicon glyphicon-trash"></i>  Borrar </button></div>';
                return html;
                }
            }
  		]
  	});
});

function addProducto()
{
    method = 'add';
    validarCodigo();
    $('#add-productos-form')[0].reset();
    $.ajax({
        url: url_base + 'productos/agregar',
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#Categoria').html('<option value="-1" selected="selected">Seleccionar</option>');
            for (var i = 0; i < data.categoria_select.length ; i++) {
                $('#Categoria').append('<option value="'+data.categoria_select[i].idCategoria+'">'+data.categoria_select[i].Nombre+'</option>');
            };
            $('#add-productos-modal').modal(modal_option);
            $('.modal-title').text('Agregar Producto');
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    })
}

function editProducto(id)
{
    method = 'edit';
    idProducto = id;
    validarCodigo();
    $('#add-productos-form')[0].reset();
    $.ajax({
        url: url_base + 'productos/editar/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#Categoria').html('<option value="-1">Seleccionar</option>');
            for (var i = 0; i < data.categoria_select.length ; i++) {
                $('#Categoria').append('<option value="'+data.categoria_select[i].idCategoria+'">'+data.categoria_select[i].Nombre+'</option>');
            };
            $('[name="Nombre"]').val(data.Nombre);
            $('[name="Codigo"]').val(data.Codigo);
            $('[name="Categoria"]').val(data.Categoria_idCategoria);
            $('[name="Descripcion"]').val(data.Descripcion);
            $('[name="Imagen"]').val(data.Imagen);
            $('#add-productos-modal').modal(modal_option); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Producto'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table_producto.ajax.reload(null,false); //reload datatable ajax 
}

function guardarProducto()
{
    $('#saveProductoBtn').text('guardando...'); //change button text
    $('#saveProductoBtn').attr('disabled',true); //set button disable 
    var url_guardar;
    if(method=='add') {
        url_guardar = url_base+'productos/guardar';
    } else {
        url_guardar = url_base+'productos/actualizar/'+idProducto;
    }
    $.ajax({
        url : url_guardar,
        type : "POST",
        data : $('#add-productos-form').serialize(),
        dataType : "JSON",
        success : function(data)
        {
            if(data.status)
            {
                $('.inputError').text('');
                $('#add-productos-modal').modal('hide');
                reload_table();
            } else {
                for (var i = 0; i < data.input_error.length; i++) 
                {
                    $('[name="'+data.input_error[i]+'"]').next().html(data.string_error[i]); //select span help-block class set text error string
                }   
            }
            $('#saveProductoBtn').html('<i class="fa fa-save"></i>  Guardar '); //change button text
            $('#saveProductoBtn').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#saveProductoBtn').html('<i class="fa fa-save"></i>  Guardar '); //change button text
            $('#saveProductoBtn').attr('disabled',false); //set button enable 
        }
    });
}

function borrarProducto(id)
{
    if(confirm('Esta seguro que desea borrar el Producto?'))
    {
        // ajax delete data to database
        $.ajax({
            url : url_base + 'productos/borrar/' +id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#add-productos-modal').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}

function validarCodigo()
{
    var valid = /^\d*$/;
    $('#msgCodigo').html("");
    $('#Codigo').focusout(function(){
        if( $('#Codigo').val() == 0 || !valid.test($('#Codigo').val()) ) {
            $('#msgCodigo').html("<span style='color:#d00e0e'>Ingrese un valor numérico mayor a 0</span>")
        } else {
            $.ajax({
                url: url_base + 'productos/verificar_codigo_ajax',
                type: "POST",
                data : "Codigo="+$('#Codigo').val(),
                dataType: "JSON",
                beforeSend: function(){
                    $('#msgCodigo').html('<span>Verificando...</span>');
                },
                success: function(data){
                    if(data.validar){
                        $('#msgCodigo').html("<span style='color:#00900A'>Código disponible</span>");
                    }
                    else {
                        $('#msgCodigo').html("<span style='color:#d00e0e'>Código no disponible</span>");
                    }
                }
            });
        }
    });
}