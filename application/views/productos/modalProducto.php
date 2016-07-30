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
                    <div class="form-group">
                        <?php echo form_label('Codigo:', 'Codigo', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_input($Codigo); ?>
                        </div>
                        <span id="msgCodigo"></span><div class="inputError"></div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Nombre:', 'Nombre', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_input($Nombre); ?>
                        </div>
                        <div class="inputError"></div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Categoría:', 'Categoria', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-6">
                            <?php echo form_dropdown($Categoria); ?>
                        </div>
                        <div class="col-md-4">
                            <button id="moreCats" type="button" class="btn btn-labeled btn-success">
                                <span class="btn-label">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </span>Nueva Categoría
                            </button>
                        </div>
                        <div class="inputError"></div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Imagen:','Imagen', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_input($Imagen); ?>
                        </div>
                        <div class="inputError"></div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Descripción:', 'Descripcion', array('class' => 'control-label col-md-2')); ?>
                        <div class="col-md-10">
                            <?php echo form_textarea($Descripcion); ?>
                        </div>
                        <div class="inputError"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>  Salir </button>
                    <button type="submit" class="btn btn-success pull-right" id="saveProductoBtn" onclick="guardarProducto()"><i class="fa fa-save"></i>  Guardar </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>