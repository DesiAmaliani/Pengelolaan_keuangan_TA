
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Laporan</h1>
          </div>
          <div class="row">
          <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Navigate Laporan</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="<?php echo site_url(); ?>admin/laporan_pertahun" class="nav-link active">Laporan Pertahun</a></li>
                      <li class="nav-item"><a href="<?php echo site_url(); ?>admin/laporan_perbulan" class="nav-link">Laporan Perbulan</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    <h4>Laporan Pertahun</h4>
                    <div class="card-header-form">
                    </div>
                  </div>
                  <div class="card-body">
                  <div class="input-group">
                  <select name="tahun"  class="form-control" placeholder="Search" >
                        <?php
                        $h= $this->db->query("SELECT year(tgl_pem) as tahun from pembayaran group by year(tgl_pem)");
                        foreach ($h->result() as $c) {
                          if($c->tahun==0){

                          }else{
                            echo '<option value="'.$c->tahun.'">'.$c->tahun.'</option>';
                          }
                        }
                        ?>
                    </select>
                      <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit" style="padding:8px 16px;"> <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    
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
