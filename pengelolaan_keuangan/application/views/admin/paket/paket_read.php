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
                    <h4>Paket Read</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                      <tr><td>Jenis Paket</td><td><?php echo $id_jp; ?></td></tr>
                      <tr><td>Bandwith</td><td><?php echo $bandwith; ?></td></tr>
                      <tr><td>Harga</td><td>Rp.<?= number_format($harga); ?></td></tr>
                      <tr><td>Kapasitas Pengguna</td><td><?php echo $kap_peng; ?></td></tr>
                    <tr><td></td><td><a href="<?php echo site_url('admin/paket') ?>" class="btn btn-default">Cancel</a></td></tr>
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
