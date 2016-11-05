<?php include('application/views/productos/parametrosProductos.php') ?>
<!-- Modal -->
<div class="modal fade" id="add-productos-modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agragar Producto</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('#', array('role' => 'form', 'id' => 'add-productos-form', 'class' => 'form-horizontal')); ?>
                <div class="box-body">    
                    <!-- Sección Código -->
                    <div class="form-group">
                        <?php echo form_label('Codigo:', 'Codigo', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_input($Codigo); ?>
                            <div class="inputError"></div><span id="msgCodigo"></span>
                        </div>
                    </div>
                    <!-- Sección Nombre -->
                    <div class="form-group">
                        <?php echo form_label('Nombre:', 'Nombre', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_input($Nombre); ?>
                            <div class="inputError"></div>
                        </div>
                    </div>
                    <!-- Sección Categoría -->
                    <div class="form-group">
                        <?php echo form_label('Categoría:', 'Categoria', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-6">
                            <?php echo form_dropdown($Categoria); ?>
                            <div class="inputError"></div>
                        </div>
                        <div class="col-md-4">
                            <button id="moreCats" type="button" class="btn btn-primary" onclick="masCategoria()">
                                <span class="btn-label">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </span>Nueva Categoría
                            </button>
                        </div>
                    </div>
                    <div class="moreCatsBox form-group" style="display:none;">
                        <label for="" class="col-md-2"></label>
                        <div class="col-md-6">
                            <?php echo form_input($newCategoria); ?>
                            <div class="inputErrorCat"></div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success" id="saveCategoriaBtn" onclick="guardarCategoriaBox()"><i class="fa fa-save"></i>  Guardar </button>
                            <button class="btn btn-danger" id="saveCategoriaBtn" onclick="$('.moreCatsBox').hide();event.preventDefault();"><i class="fa fa-remove"></i>  Cancelar </button>
                        </div>
                    </div>
                    <!-- Sección Tipo Producto -->
                    <div class="form-group">
                        <?php echo form_label('Tipo Producto:', 'Tipo Producto', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-6">
                            <?php echo form_dropdown($TipoProducto); ?>
                            <div class="inputError"></div>
                        </div>
                        <div class="col-md-4">
                            <button id="moreTipoProd" type="button" class="btn btn-primary" onclick="masTipoProducto()">
                                <span class="btn-label">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </span>Nuevo Tipo Producto
                            </button>
                        </div>
                    </div>
                    <div class="moreTipoProdBox form-group" style="display:none;">
                        <label for="" class="col-md-2"></label>
                        <div class="col-md-6">
                            <?php echo form_input($newTipoProducto); ?>
                            <div class="inputErrorTipoProd"></div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-success" id="saveTipoProdBtn" onclick="guardarTipoProdBox()"><i class="fa fa-save"></i>  Guardar </button>
                            <button class="btn btn-danger" id="saveTipoProdBtn" onclick="$('.moreTipoProdBox').hide();event.preventDefault();"><i class="fa fa-remove"></i>  Cancelar </button>
                        </div>
                    </div>
                    <!-- Sección Imagen -->
                    <div class="form-group">
                        <?php echo form_label('Imagen:','Imagen', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_input($Imagen); ?>
                            <div class="inputError"></div>                            
                        </div>
                    </div>
                    <!-- Sección Descripción -->
                    <div class="form-group">
                        <?php echo form_label('Descripción:', 'Descripcion', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_textarea($Descripcion); ?>
                            <div class="inputError"></div>
                        </div>                        
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>  Salir </button>
                    <button type="submit" class="btn btn-success pull-right" id="saveProductoBtn" onclick="guardarProducto()"><i class="fa fa-save"></i>  Guardar </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
