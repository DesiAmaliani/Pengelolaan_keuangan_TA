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
                    <h4>Data BTS Read</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                      <tr><td>Nama Bts</td><td><?php echo $nama_bts; ?></td></tr>
                        <tr><td>Alamat Bts</td><td><?php echo $alamat_bts; ?></td></tr>
                        <tr><td>Titik Koordinat BTS</td><td><?php 
                            echo anchor(site_url('data_bts/lokasi/'.$id_bts),'Lokasi'); 
                           ?></td></tr>
                    <tr><td></td><td><a href="<?php echo site_url('admin/data_bts') ?>" class="btn btn-default">Cancel</a></td></tr>
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
