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
                    <h4>Info IP Client Read</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                      <tr><td>Nama Client</td><td><?php echo $id_client; ?></td></tr>
                        <tr><td>Username Pppoe</td><td><?php echo $user_pppoe; ?></td></tr>
                        <tr><td>Password Ppoe</td><td><?php echo $pass_ppoe; ?></td></tr>
                        <tr><td>IP Radio</td><td><?php echo $ip_radio; ?></td></tr>
                        <tr><td>Nama Radio</td><td><?php echo $nama_radio; ?></td></tr>
                        <tr><td>IP Router</td><td><?php echo $ip_router; ?></td></tr>
                        <tr><td>Username / Password Router</td><td><?php echo $user_paas_router; ?></td></tr>
                        <tr><td>Merk Router</td><td><?php echo $merk_router; ?></td></tr>
                    <tr><td></td><td><a href="<?php echo site_url('admin/info_ip_client') ?>" class="btn btn-default">Cancel</a></td></tr>
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
