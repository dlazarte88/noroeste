  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>img/user2.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-link"></i> <span>Inicio</span></a></li>
        <li><a href="<?php echo base_url(); ?>usuarios"><i class="fa fa-link"></i> <span>Usuarios</span></a></li>
        <li><a href="<?php echo base_url(); ?>productos"><i class="fa fa-link"></i> <span>Productos</span></a></li>
        <li><a href="<?php echo base_url(); ?>pedidos"><i class="fa fa-link"></i> <span>Pedidos</span></a></li>
        <li><a href="<?php echo base_url(); ?>articulos"><i class="fa fa-link"></i> <span>Artículos</span></a></li>
        <li><a href="<?php echo base_url(); ?>auth/logout"><i class="fa fa-link"></i> <span>Salir</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>