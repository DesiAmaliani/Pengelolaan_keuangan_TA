<?php
$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$z=0;
foreach($grafik as $a){
  if($a->bulan==1){
    $bulan="Januari";
  }elseif($a->bulan==2){
    $bulan="Februari";
  }elseif($a->bulan==3){
    $bulan="Maret";
  }elseif($a->bulan==4){
    $bulan="April";
  }elseif($a->bulan==5){
    $bulan="Mei";
  }elseif($a->bulan==6){
    $bulan="Juni";
  }elseif($a->bulan==7){
    $bulan="Juli";
  }elseif($a->bulan==8){
    $bulan="Agustus";
  }elseif($a->bulan==9){
    $bulan="September";
  }elseif($a->bulan==10){
    $bulan="Oktober";
  }elseif($a->bulan==11){
    $bulan="November";
  }elseif($a->bulan==12){
    $bulan="Desember";
  }else{
    $bulan="tidak ada";
  }
  $tgl[] = $bulan;
  $z += $a->total;
 $s[] = (double) $z; 
}
?>
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Pengeluaran</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Line Chart</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart"></canvas>
                    
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Pengeluaran</h4>
                    <div class="card-header-form">
                    <form action="<?php echo site_url('pengeluaran/index'); ?>" class="form-inline" method="get">
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
                        <th>ID Pengeluaran</th>
                        <th>Tanggal Pengeluaran</th>
                        <th>Keterangan</th>
                        <th>Total Pengeluaran</th>
                        <th>Bukti Pengeluaran</th>
                        <th><?php echo anchor(site_url('pengeluaran/create'),'Create', 'class="btn btn-primary"'); ?></th>
                        </tr><?php
                        $total = 0;
                        foreach ($pengeluaran_data as $pengeluaran)
                        {
                            ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                          <td><?php echo $pengeluaran->id_peng ?></td>
                          <td><?php echo $pengeluaran->tgl_peng ?></td>
                            <td><?php echo $pengeluaran->ket ?></td>
                            <td>Rp.<?= number_format($pengeluaran->total_peng) ;?></td>
                          <td>
                         <img src="<?php echo base_url(); ?>tampilan/pengeluaran/<?php echo $pengeluaran->bukti_peng ?>" alt="logo" width="80" class="shadow-light"></td>
                          <td><?php 
                          echo anchor(site_url('pengeluaran/read/'.$pengeluaran->id_peng),'Read'); 
                          echo ' | '; 
                          echo anchor(site_url('pengeluaran/update/'.$pengeluaran->id_peng),'Update'); 
                          echo ' | '; 
                          echo anchor(site_url('pengeluaran/delete/'.$pengeluaran->id_peng),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                          ?></td>
                        </tr>
                        <?php
                          $total += $pengeluaran->total_peng+0;
                        }
                        ?>
                        <tr>
                          <th colspan="4"><center>Total Pengeluaran</center></th>
                          <th colspan="3">Rp.<?= number_format($total) ;?></th>
                      </tr>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-left">
                  <?php echo anchor(site_url('pengeluaran/word'), 'Word', 'class="btn btn-primary"'); ?>
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
  <script>
	var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels:  <?php echo json_encode($tgl);?>,
    datasets: [{
      // label: 'Statistics',
      data:  <?php echo json_encode($s);?>,
      borderWidth: 2,
      backgroundColor: '#6777ef',
      borderColor: '#6777ef',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: false,
          stepSize: 1500
        }
      }],
      xAxes: [{
        ticks: {
          display: true
        },
        gridLines: {
          display: false
        }
      }]
    },
  }
});
	</script>