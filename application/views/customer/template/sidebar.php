  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
       <span class="brand-text font-weight-light">SPK. Pemilihan Laptop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="<?=base_url('customer/profil')?>"> <img src="<?=base_url()?>/assets/<?=$akun->foto?>" class="img-circle elevation-2" alt="User Image" style="width: 35px;height: 35px">
        </a>
        </div>
        <div class="info">
          <a href="<?=base_url('customer/profil')?>" class="d-block"><?=$profil->nama_customer?></a>
        </div>
      </div>

  

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <?php if ($index == 0): ?>
            <a href="<?=base_url('customer')?>"  class="nav-link active">
            <?php else: ?>
            <a href="<?=base_url('customer')?>"  class="nav-link">
            <?php endif; ?>
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <?php if ($index == 1): ?>
            <a href="<?=base_url('customer/laptopanda')?>"  class="nav-link active">
            <?php else: ?>
            <a href="<?=base_url('customer/laptopanda')?>"  class="nav-link">
            <?php endif; ?>
              <i class="nav-icon fas fa-laptop"></i>
              <p>
                Laptop Anda 
              </p>
            </a>
          </li>
          
          <li class="nav-header">Pengaturan</li>
          <li class="nav-item">
            <?php if ($index == 7): ?>
            <a href="<?=base_url('customer/Profil')?>"  class="nav-link active">
            <?php else: ?>
            <a href="<?=base_url('customer/Profil')?>"  class="nav-link">
            <?php endif; ?>
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Profil 
              </p>
            </a>
          </li>
          <li class="nav-item"> 
            <a href="<?=base_url('logout')?>"  class="nav-link"> 
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout 
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
