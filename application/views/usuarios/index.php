<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        USUARIOS
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="addUsuario()"><i class="glyphicon glyphicon-plus"></i>  Agregar </button>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Usuarios</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="usuario-table" class="table table-bordered table-hover" width="100%">
                <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Correo</th>
                  <th>Teléfono</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Correo</th>
                  <th>Télefono</th>
                  <th>Accion</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php include('application/views/usuarios/modalUsuario.php') ?>