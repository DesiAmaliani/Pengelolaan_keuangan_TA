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
                    <h4>Client Read</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                      <tr><td>Nama Lengkap</td><td><?php echo $nama_lengkap; ?></td></tr>
                        <tr><td>Username</td><td><?php echo $username; ?></td></tr>
                        <tr><td>Password</td><td><?php echo $password; ?></td></tr>
                        <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
                        <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
                        <tr><td>Foto</td><td><img src="<?php echo base_url(); ?>tampilan/profil/client/<?php echo $foto ?>" alt="logo" width="80" class="shadow-light rounded-circle"></td></tr>
                        <tr><td></td><td><a href="<?php echo site_url('admin/client') ?>" class="btn btn-default">Cancel</a></td></tr>
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

