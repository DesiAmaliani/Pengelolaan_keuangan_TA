
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Akun Admin</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Admin</h4>
                    <div class="card-header-form">
                    <form action="<?php echo site_url('admin/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search"  name="q" value="<?php echo $q; ?>">
                          <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <?php
                                }
                            ?>
                          <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div id="message">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                          <th>No</th>
                          <th>Nama Lengkap</th>
                          <th>Email</th>
                        <th>Username</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Active</th>
                        <th>Foto</th>
                        <th><?php echo anchor(site_url('admin/create'),'Create', 'class="btn btn-primary"'); ?></th>
                        </tr><?php
                        foreach ($admin_data as $admin)
                        {
                            ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                          <td><?php echo $admin->nama_lengkap ?></td>
                          <td><?php echo $admin->email ?></td>
                          <td><?php echo $admin->username ?></td>
                          <td><?php echo $admin->no_hp ?></td>
                          <td><?php echo $admin->alamat ?></td>
                          <td><?php if($admin->active!=0){echo "Aktif";}else{echo "Tidak Aktif";} ?></td>
                          <td>
                         <img src="<?php echo base_url(); ?>tampilan/profil/admin/<?php echo $admin->foto ?>" alt="logo" width="80" class="shadow-light rounded-circle"></td>
                          <td><?php 
                          echo anchor(site_url('admin/read/'.$admin->id_admin),'Read'); 
                          echo ' | '; 
                          echo anchor(site_url('admin/update/'.$admin->id_admin),'Update'); 
                          echo ' | '; 
                          echo anchor(site_url('admin/delete/'.$admin->id_admin),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                          ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                  <?php echo $pagination ?>
                  </div>
                </div>
              </div>
            </div>
          
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Design By PT. Cuplik Media Center
        </div>
        <div class="footer-right">
         
        </div>
      </footer>
    </div>
  </div>

