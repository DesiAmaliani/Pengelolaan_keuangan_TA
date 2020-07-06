<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"><img src="<?php echo base_url(); ?>tampilan/assets/img/a.PNG" alt="logo" width="200" ></a>
          </div>
          <div class="sidebar-brand">
            
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">
              <img src="<?php echo base_url(); ?>tampilan/assets/img/logo-cuplik.PNG" alt="logo" width="40" class="shadow-light rounded-circle">
            </a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown">
                <a href="<?php echo site_url(); ?>admin/beranda_admin" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Data Akun</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Data Akun</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo site_url(); ?>admin/admin">Akun Admin</a></li>
                  <li><a class="nav-link" href="<?php echo site_url(); ?>admin/kasir">Akun Kasir</a></li>
                  <li><a class="nav-link" href="<?php echo site_url(); ?>admin/client">Akun Client</a></li>
                </ul>
              </li>
              <li class="menu-header">Paket</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-pencil-ruler"></i> <span>Paket</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo site_url(); ?>admin/paket">Paket</a></li>
                </ul>
              </li>
              <li class="menu-header">Data Keuangan</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-dollar-sign"></i> <span>Kelola Keuangan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?php echo site_url(); ?>admin/pemasukan">Pemasukan</a></li>
                  <li><a class="nav-link" href="<?php echo site_url(); ?>admin/pengeluaran">Pengeluaran</a></li>
                  <li><a class="nav-link" href="<?php echo site_url(); ?>admin/laporan_pertahun">Laporan</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo site_url(); ?>admin/transaksi" class="nav-link"><i class="fas fa-pencil-ruler"></i> <span>Transaksi</span></a>
              </li>
              <li class="nav-item dropdown">
                <a href="<?php echo site_url(); ?>admin/tagihan" class="nav-link"><i class="fas fa-pencil-ruler"></i> <span>Tagihan</span></a>
              </li>
            </ul>
        </aside>
      </div>