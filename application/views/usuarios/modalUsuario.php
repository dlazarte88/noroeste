<?php include('application/views/usuarios/parametrosUsuario.php') ?>
<!-- Modal -->
  <div class="modal fade" id="add-usuario-modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agragar Usuario</h4>
        </div>
        <div class="modal-body">
          <?php echo form_open('#', array('role' => 'form', 'id' => 'add-usuario-form')); ?>
          <div class="form-group">
              <?php echo form_label('Usuario:'); ?>
              <span id="msgCodigo"></span>
              <?php echo form_input($Usuario); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Nombre:'); ?>
              <?php echo form_input($Nombre); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Apellido:'); ?>
              <?php echo form_input($Apellido); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Email:'); ?>
              <?php echo form_input($Email); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Teléfono:'); ?>
              <?php echo form_input($Telefono); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Contraseña:'); ?>
              <?php echo form_input($Contraseña); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Confirmar Contraseña:'); ?>
              <?php echo form_input($ConfirmarContraseña); ?>
              <div class="inputError"></div>
          </div>
          <div class="form-group">
              <?php echo form_label('Grupo:'); ?>
              <?php echo form_dropdown($Grupo); ?>
              <div class="inputError"></div>
          </div>          
          
          <button type="submit" class="btn btn-success" id="saveUsuarioBtn" onclick="guardarUsuario()"><i class="fa fa-save"></i>  Guardar </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>  Salir </button>
        <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>