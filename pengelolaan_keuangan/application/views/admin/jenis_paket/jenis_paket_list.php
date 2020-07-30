
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Jenis Paket</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Jenis Paket</h4>
                    <div class="card-header-form">
                    <form action="<?php echo site_url('jenis_paket/index'); ?>" class="form-inline" method="get">
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
		                <th>Nama Jenis paket</th>
                        <th><?php echo anchor(site_url('jenis_paket/create'),'Create', 'class="btn btn-primary"'); ?></th>
                        </tr><?php
                                foreach ($jenis_paket_data as $jenis_paket)
                                {
                        ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                          <td><?php echo $jenis_paket->nama_jp ?></td>
                            <td style="text-align:center" width="200px">
                                <?php 
                                echo anchor(site_url('jenis_paket/read/'.$jenis_paket->id_jp),'Read'); 
                                echo ' | '; 
                                echo anchor(site_url('jenis_paket/update/'.$jenis_paket->id_jp),'Update'); 
                                echo ' | '; 
                                echo anchor(site_url('jenis_paket/delete/'.$jenis_paket->id_jp),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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