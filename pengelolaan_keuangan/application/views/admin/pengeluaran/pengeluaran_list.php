<?php
$z=0;
if($grafik==0){

}else{
 foreach($grafik as $a){
  if($a->tahun==0){
    $tgl=0;
    $s=0;
   }else{
    $tgl[] = $a->tahun;
  // $z += $a->total_peng;
    $s[] = $a->total; 
   }
}
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
                    <div class="card-header-form">
                    <form method="post" name="form1" action="?proses=cetak">
                        <div class="input-group">
                        <select name="tahun"  class="form-control" placeholder="Search" >
                        <?php
                        $h= $this->db->query("SELECT year(tgl_peng) as tahun from pengeluaran group by year(tgl_peng)");
                        foreach ($h->result() as $c) {
                           echo '<option value="'.$c->tahun.'">'.$c->tahun.'</option>';
                        }
                        ?>
                        </select>
                          <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit" style="padding: 10px 16px;"> <i class="fas fa-search"></i></button>
                            <a href="<?php echo base_url(); ?>admin/pengeluaran">Reset Filter</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body">
                  <?php
                    $proses=$this->input->get('proses',TRUE);
                    $tahun=$this->input->post('tahun',TRUE);
                    if($proses=='cetak'){
                        //jika dicari
                    ?> 
                    <h5><center>Data Grafik Pengeluaran <?php echo $tahun;?></center></h5>
                    <?php  
                    $query = $this->db->query("SELECT Sum(total_peng) as total_p, MONTH(tgl_peng) as bulan FROM pengeluaran Where Year(tgl_peng)='$tahun' group by MONTH(tgl_peng) , Year(tgl_peng)='$tahun'");
                    if($query->num_rows() > 0){
                        $zpen=0;
                        foreach($query->result() as $data){
                            $hasil[] = $data;
                                  if($data->bulan==1){
                                    $bulan="Januari";
                                  }elseif($data->bulan==2){
                                    $bulan="Februari";
                                  }elseif($data->bulan==3){
                                    $bulan="Maret";
                                  }elseif($data->bulan==4){
                                    $bulan="April";
                                  }elseif($data->bulan==5){
                                    $bulan="Mei";
                                  }elseif($data->bulan==6){
                                    $bulan="Juni";
                                  }elseif($data->bulan==7){
                                    $bulan="Juli";
                                  }elseif($data->bulan==8){
                                    $bulan="Agustus";
                                  }elseif($data->bulan==9){
                                    $bulan="September";
                                  }elseif($data->bulan==10){
                                    $bulan="Oktober";
                                  }elseif($data->bulan==11){
                                    $bulan="November";
                                  }elseif($data->bulan==12){
                                    $bulan="Desember";
                                  }else{
                                    $bulan="tidak ada";
                                   }
                            $tglpen[] = $bulan;
                            // $zpen += $data->total_peng;
                            $spen[] = (double) $data->total_p; 
                        }
                    }
                    
                    ?>
                            <canvas id="myChartper"></canvas>
                             <script>
                                    var ctx = document.getElementById("myChartper").getContext('2d');
                                    var myChartper = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels:  <?php echo json_encode($tglpen);?>,
                                        datasets: [{
                                        // label: 'Statistics',
                                        data:  <?php echo json_encode($spen);?>,
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
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <h4>Table Pengeluaran</h4>
                                
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
                                    $hasil3= $this->db->query("SELECT * from pengeluaran where year(tgl_peng)='$tahun'");
                                    $d=$hasil3->num_rows();
                                    if($d==0){
                                        echo "<tr><td colspan='2'>Maaf Data Yang anda cari tidak ada</td></tr>";
                                    }else{
                                    $hasil2= $this->db->query("SELECT * from pengeluaran where year(tgl_peng)='$tahun'");
                                    $start1=0;
                                    $total=0;
                                    foreach ($hasil2->result() as $pengeluaran1)
                                    {
                                        ?>
                                    <tr>
                                        <td class="p-0 text-center">
                                        <?php echo ++$start1 ?>
                                        </td>
                                        <td><?php echo $pengeluaran1->id_peng ?></td>
                                        <td><?php echo $pengeluaran1->tgl_peng ?></td>
                                        <td><?php echo $pengeluaran1->ket ?></td>
                                        <td>Rp.<?= number_format($pengeluaran1->total_peng) ;?></td>
                                        <td>
                                    <img src="<?php echo base_url(); ?>tampilan/pengeluaran/<?php echo $pengeluaran1->bukti_peng ?>" alt="logo" width="80" class="shadow-light"></td>
                                        <td><?php 
                                        echo anchor(site_url('pengeluaran/read/'.$pengeluaran1->id_peng),'Read'); 
                                        echo ' | '; 
                                        echo anchor(site_url('pengeluaran/update/'.$pengeluaran1->id_peng),'Update'); 
                                        echo ' | '; 
                                        echo anchor(site_url('pengeluaran/delete/'.$pengeluaran1->id_peng),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                                        ?></td>
                                    </tr>
                                    <?php
                                    $total += $pengeluaran1->total_peng+0;
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
                                <?php echo anchor(site_url('pengeluaran/word_tahun/'.$tahun), 'Word', 'class="btn btn-primary"'); ?>
                                </div>
                                <div class="card-footer text-right">
                                <?php echo $pagination ?>
                                </div>
                                
                            </div>
                            </div>
                        </div>


             <!-- tampilan awal -->
                    <?php } }else{?>
                    <h5><center>Data Grafik Semua Pengeluaran</center></h5>
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
                        $hasil4= $this->db->query("SELECT * from pengeluaran");
                        $f=$hasil4->num_rows();
                        if($f==0){
                        echo "<tr><td colspan='2'><center>Maaf Data Yang anda cari tidak ada</center></td></tr>";
                        }else{
                        $total=0;
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
            <?php } }?>



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