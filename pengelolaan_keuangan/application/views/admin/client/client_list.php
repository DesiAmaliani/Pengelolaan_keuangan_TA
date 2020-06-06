
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Akun Client</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Client</h4>
                    <div class="card-header-form">
                    <form action="<?php echo site_url('client/index'); ?>" class="form-inline" method="get">
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
                        <th>Paket</th>
                        <th><?php echo anchor(site_url('client/create'),'Create', 'class="btn btn-primary"'); ?></th>
                        </tr><?php
                        foreach ($client_data as $client)
                        {
                            ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                          <td><?php echo $client->nama_lengkap ?></td>
                            <td><?php echo $client->username ?></td>
                            <td><?php echo $client->password ?></td>
                            <td><?php echo $client->no_hp ?></td>
                            <td><?php echo $client->alamat ?></td>
                              <td><img src="<?php echo base_url(); ?>tampilan/profil/<?php echo $client->foto ?>" alt="logo" width="80" class="shadow-light rounded-circle"></td></td>
                              <?php
                          $sql= $this->db->query("SELECT id_paket FROM client WHERE id_client='$id_client'");
                          foreach ($sql->result() as $sql1) {?>
                            <td><?php echo $sql1->nama; ?></td>
                            <?php
                          }
                          ?>
                            <td style="text-align:center" width="200px">
                                <?php 
                                echo anchor(site_url('client/read/'.$client->id_client),'Read'); 
                                echo ' | '; 
                                echo anchor(site_url('client/update/'.$client->id_client),'Update'); 
                                echo ' | '; 
                                echo anchor(site_url('client/delete/'.$client->id_client),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                ?>
                            </td>
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
