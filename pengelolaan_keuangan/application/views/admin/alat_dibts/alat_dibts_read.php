 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Read </h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Alat DiBts Read</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                      <tr><td>Nama Bts</td><td><?php
                       $Bts=$this->db->query("Select nama_bts from data_bts where id_bts='$id_bts'");
                       foreach ($Bts->result() as $bts) {
                         echo $bts->nama_bts;
                       }
                        ?></td></tr>
                        <tr><td>Nama Alat</td><td><?php echo $nama_alat; ?></td></tr>
                        <tr><td>IP Alat</td><td><?php echo $ip_alat; ?></td></tr>
                        <tr><td>SSID</td><td><?php echo $ssid; ?></td></tr>
                        <tr><td>Frequensi</td><td><?php echo $frequensi; ?></td></tr>
                    <tr><td></td><td><a href="<?php echo site_url('admin/alat_dibts') ?>" class="btn btn-default">Cancel</a></td></tr>
                </table>
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
