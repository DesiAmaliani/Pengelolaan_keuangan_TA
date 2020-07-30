
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Info IP Client</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Info IP Client</h4>
                    <div class="card-header-form">
                    <form action="<?php echo site_url('info_ip_client/index'); ?>" class="form-inline" method="get">
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
		                <th>Nama Client</th>
                        <th>Username Pppoe</th>
                        <th>Password Ppoe</th>
                        <th>IP Radio</th>
                        <th>Nama Radio</th>
                        <th>IP Router</th>
                        <th>Username / Password Router</th>
                        <th>Merk Router</th>
                        <th><?php echo anchor(site_url('info_ip_client/create'),'Create', 'class="btn btn-primary"'); ?></th>
                        </tr><?php
                                foreach ($info_ip_client_data as $info_ip_client)
                                {
                        ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                          <td><?php echo $info_ip_client->nama_lengkap ?></td>
                            <td><?php echo $info_ip_client->user_pppoe ?></td>
                            <td><?php echo $info_ip_client->pass_ppoe ?></td>
                            <td><?php echo $info_ip_client->ip_radio ?></td>
                            <td><?php echo $info_ip_client->nama_radio ?></td>
                            <td><?php echo $info_ip_client->ip_router ?></td>
                            <td><?php echo $info_ip_client->user_paas_router ?></td>
                            <td><?php echo $info_ip_client->merk_router ?></td>
                            <td style="text-align:center" width="200px">
                                <?php 
                                echo anchor(site_url('info_ip_client/read/'.$info_ip_client->id_infoip),'Read'); 
                                echo ' | '; 
                                echo anchor(site_url('info_ip_client/update/'.$info_ip_client->id_infoip),'Update'); 
                                echo ' | '; 
                                echo anchor(site_url('info_ip_client/delete/'.$info_ip_client->id_infoip),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                      </table>
                      <div class="card-footer text-left">
                  <?php echo anchor(site_url('info_ip_client/excel'), 'Excel', 'class="btn btn-success"'); ?>
                  </div>
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