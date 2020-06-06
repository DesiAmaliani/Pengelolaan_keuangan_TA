 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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
                    $kasir = $this->db->query("SELECT Count(id_kasir) as jumlah FROM kasir");
                    foreach($kasir->result() as $kasir){
                      echo $kasir->jumlah;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Client</h4>
                  </div>
                  <div class="card-body">
                  <?php
                    $client = $this->db->query("SELECT Count(id_client) as jumlah FROM client");
                    foreach($client->result() as $client){
                      echo $client->jumlah;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pemasukan</h4>
                  </div>
                  <div class="card-body">
                  <?php
                    $pemasukan = $this->db->query("SELECT SUM(total_bayar) as total FROM pembayaran where status=2;");
                    foreach($pemasukan->result() as $pem){
                      echo "Rp ".number_format($pem->total);
                      $pem=$pem->total;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pengeluaran</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    $pengeluaran = $this->db->query("SELECT SUM(total_peng) as total FROM pengeluaran");
                    foreach($pengeluaran->result() as $peng){
                      echo "Rp ".number_format($peng->total);
                      $peng=$peng->total;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sisa Saldo</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      $sisa= $pem - $peng;
                      echo "Rp ".number_format($sisa);
                    ?>
                  </div>
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