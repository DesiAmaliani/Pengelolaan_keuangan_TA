
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Akun Kasir</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Kasir</h4>
                    <div class="card-header-form">
                    <form action="<?php echo site_url('kasir/index'); ?>" class="form-inline" method="get">
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
                        <th>Username</th>
                        <th>Password</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th><?php echo anchor(site_url('kasir/create'),'Create', 'class="btn btn-primary"'); ?></th>
                        </tr><?php
                        foreach ($kasir_data as $kasir)
                        {
                            ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                          <td><?php echo $kasir->nama_lengkap ?></td>
                          <td><?php echo $kasir->username ?></td>
                          <td><?php echo $kasir->password ?></td>
                          <td><?php echo $kasir->no_hp ?></td>
                          <td><?php echo $kasir->alamat ?></td>
                          <td>
                         <img src="<?php echo base_url(); ?>tampilan/profil/<?php echo $kasir->foto ?>" alt="logo" width="80" class="shadow-light rounded-circle"></td>
                          <td><?php 
                          echo anchor(site_url('kasir/read/'.$kasir->id_kasir),'Read'); 
                          echo ' | '; 
                          echo anchor(site_url('kasir/update/'.$kasir->id_kasir),'Update'); 
                          echo ' | '; 
                          echo anchor(site_url('kasir/delete/'.$kasir->id_kasir),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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

