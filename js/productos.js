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

    table_categoria = $('#categoria-table').DataTable({
        "processing": true,
        "ajax": url_base + 'categorias/listar',
        "columnDefs": [
            {"data" : "idCategoria","targets":[0]},
            {"data" : "Nombre","targets":[1]},
            {
            "data" : "idCategoria",
            "targets" :[2],
            "orderable": false,
            "render" : function ( data, type, full, meta ) {
                var html = '<div class="accion-categoria">'
                html += '<button type="button" class="btn btn-primary" data-toggle="modal" onclick="editCategoria('+data+')"><i class="glyphicon glyphicon-pencil"></i>  Editar </button>';
                html += '<button type="button" class="btn btn-danger" data-toggle="modal" onclick="borrarCategoria('+data+')"><i class="glyphicon glyphicon-trash"></i>  Borrar </button></div>';
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
        url: url_base + 'productos/listarProducto',
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#Categoria').html('<option value="-1" selected="selected">Seleccionar</option>');
            for (var i = 0; i < data.categoria_select.length ; i++) {
                $('#Categoria').append('<option value="'+data.categoria_select[i].idCategoria+'">'+data.categoria_select[i].Nombre+'</option>');
            };
            $('#TipoProducto').html('<option value="-1" selected="selected">Seleccionar</option>');
            for (var i = 0; i < data.tipo_producto_select.length ; i++) {
                $('#TipoProducto').append('<option value="'+data.tipo_producto_select[i].idTipo_Productos+'">'+data.tipo_producto_select[i].Nombre+'</option>');
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

function editCategoria(id)
{
    $('.inputErrorCat').text('');
    method = 'edit';
    idCategoria = id;
    $('#add-categorias-form')[0].reset();
    $.ajax({
        url : url_base + 'categorias/editar/' + id,
        type : "GET",
        dataType : "JSON",
        success: function(data)
        {
            $('[name="NombreCategoria"]').val(data.Nombre);
            $('#add-categorias-modal').modal(modal_option);
            $('.modal-title').text('Editar Categoría');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
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
                table_producto.ajax.reload(null,false);
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

function guardarCategoria()
{
    $('#saveCategoriaBtn').text('guardando...');
    $('#saveCategoriaBtn').attr('disabled',true);
    var url_guardar;
    if(method=='add') {
        url_guardar = url_base+'categorias/guardar';
    } else {
        url_guardar = url_base+'categorias/actualizar/'+idCategoria;
    }
    $.ajax({
        url : url_guardar,
        type : "POST",
        data : $('#add-categorias-form').serialize(),
        dataType : "JSON",
        success : function(data)
        {
            if (data.status) {
                $('.inputError').text('');
                $('#add-categorias-modal').modal('hide');
                table_categoria.ajax.reload(null,false);
            } else {
                $('.inputErrorCat').html('Debe ingresar un nombre para la Categoría');
            }
            $('#saveCategoriaBtn').html('<i class="fa fa-save"></i>  Guardar '); //change button text
            $('#saveCategoriaBtn').attr('disabled',false); //set button enable
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#saveCategoriaBtn').html('<i class="fa fa-save"></i>  Guardar '); //change button text
            $('#saveCategoriaBtn').attr('disabled',false); //set button enable 
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
                table_producto.ajax.reload(null,false);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
    }
}

function borrarCategoria(id)
{
    if(confirm('Esta seguro que desea borrar la Categoría'))
    {
        $.ajax({
            url : url_base + 'categorias/borrar/' + id,
            type : "POST",
            dataType : "JSON",
            success: function(data)
            {
                $('#add-categorias-modal').modal('hide');
                table_categoria.ajax.reload(null,false);
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

function masCategoria()
{
    var display = $('.moreCatsBox').css('display');
    $('#newCategoria').attr("placeholder", "Nueva Categoría");
    if ('none' === display) {
        $(".moreCatsBox").toggle(true);
    } else {
        $(".moreCatsBox").toggle(false);
    }
}

function masTipoProducto()
{
    var display = $('.moreTipoProdBox').css('display');
    $('#newTipoProducto').attr("placeholder", "Nuevo Tipo Producto");
    if ('none' === display) {
        $(".moreTipoProdBox").toggle(true);
    } else {
        $(".moreTipoProdBox").toggle(false);
    }
}

function guardarCategoriaBox()
{
    event.preventDefault();
    var catName = $('#newCategoria').val();
    if (catName != ''){
        $.ajax({
            url : url_base + 'productos/guardarCategoria',
            type : "POST",
            data : { Nombre: catName },
            dataType : "JSON",
            success : function(data)
            {
                $('.inputErrorCat').text('');
                $('#newCategoria').val('');
                reloadCategoria();
                $('.moreCatsBox').hide();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al crear Categoría');
            }
        });
    } else {
        $('.inputErrorCat').html('Debe ingresar un nombre para la Categoría');
    }
}

function reloadCategoria()
{
    $.ajax({
        url : url_base + 'productos/listarCategoria',
        type : "GET",
        dataType : "JSON",
        success: function(data)
        {
            $('#Categoria').html('<option value="-1">Seleccionar</option>');
            for (var i = 0; i < data.categoria_select.length ; i++) {
                $('#Categoria').append('<option value="'+data.categoria_select[i].idCategoria+'">'+data.categoria_select[i].Nombre+'</option>');
            };
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function addCategoria()
{
    method = 'add';
    $('.inputErrorCat').text('');
    $('#add-categorias-form')[0].reset();
    $('#add-categorias-modal').modal(modal_option);
}