 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Admin</h4>
                  </div>
                  <div class="card-body">
                  <?php
                    $admin = $this->db->query("SELECT Count(id_admin) as jumlah FROM admin");
                    foreach($admin->result() as $admin){
                      echo $admin->jumlah;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Kasir</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    $admin = $this->db->query("SELECT Count(id_admin) as jumlah FROM admin");
                    foreach($admin->result() as $admin){
                      echo $admin->jumlah;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sisa Saldo</h4>
                  </div>
                  <div class="card-body">
                  <?php
                    $pemasukan = $this->db->query("SELECT SUM(total_bayar) as total FROM pembayaran where status=2;");
                    foreach($pemasukan->result() as $pem){
                      $pem=$pem->total;
                    }
                    $pengeluaran = $this->db->query("SELECT SUM(total_peng) as total FROM pengeluaran");
                    foreach($pengeluaran->result() as $peng){
                      $peng=$peng->total;
                    }
                    $sisa= $pem - $peng;
                    echo "Rp ".number_format($sisa);
                    ?>
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