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
          <?php echo form_open('#', array('role' => 'form', 'id' => 'add-productos-form')); ?>
          <div class="form-group">
              <?php echo form_label('Nombre:'); ?>
              <?php echo form_input($Nombre); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Codigo:'); ?>
              <span id="msgCodigo"></span>
              <?php echo form_input($Codigo); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Categoría:'); ?>
              <?php echo form_dropdown($Categoria); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Imagen:'); ?>
              <?php echo form_input($Imagen); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Descripción:'); ?>
              <?php echo form_textarea($Descripcion); ?>
              <div class="inputError"></div>
          </div>
          <button type="submit" class="btn btn-success" id="saveProductoBtn" onclick="guardarProducto()"><i class="fa fa-save"></i>  Guardar </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>  Salir </button>
        <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>