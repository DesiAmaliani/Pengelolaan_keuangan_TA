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
                    <h4>Pengeluaran Read</h4>
                  </div>
                  <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped">
                      <tr><td>ID Pengeluaran</td><td><?php echo $id_peng; ?></td></tr>
                      <tr><td>Tanggal Pengeluaran</td><td><?php echo $tgl_peng; ?></td></tr>
                        <tr><td>Keterangan</td><td><?php echo $ket; ?></td></tr>
                        <tr><td>Total Pengeluaran</td><td><?php echo $total_peng; ?></td></tr>
                        <tr><td><b>Bukti Pengeluaran</b></td><td><img src="<?php echo base_url(); ?>tampilan/pengeluaran/<?php echo $bukti_peng ?>" alt="logo" width="80" class="shadow-light "></td></tr>
                        <tr><td></td><td><a href="<?php echo site_url('admin/pengeluaran') ?>" class="btn btn-default">Cancel</a></td></tr>
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