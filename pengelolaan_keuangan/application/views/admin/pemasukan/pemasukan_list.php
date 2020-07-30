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
            <h1>Data Pemasukan</h1>
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
                            <button class="btn btn-primary" type="submit" style="padding: 10px 16px;"> <i class="fas fa-search"></i></button>
                            <a href="<?php echo base_url(); ?>admin/pemasukan">Reset Filter</a>
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
                    <h5><center>Data Grafik Pemasukan <?php echo $tahun;?></center></h5>
                    <?php  
                    $query = $this->db->query("SELECT Sum(total_bayar) as total_p, MONTH(tgl_pem) as bulan FROM pembayaran Where Year(tgl_pem)='$tahun' AND status=2 group by MONTH(tgl_pem) , Year(tgl_pem)='$tahun'");
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
                                <h4>Table Pemasukan</h4>
                                
                                </div>
                                <div id="message">
                                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                </div>
                                <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                    <tr>
                                    <th>No</th>
                                    <th>ID Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Nama Client</th>
                                    <th>Nama Paket</th>
                                    <th>Periode</th>
                                    <th>Total Bayar</th>
                                    <th><?php echo anchor(site_url('pemasukan/create'),'Create', 'class="btn btn-primary"'); ?></th>
                                    </tr><?php
                                    $total = 0;
                                    $hasil3= $this->db->query("SELECT * from pembayaran where year(tgl_pem)='$tahun'");
                                    $d=$hasil3->num_rows();
                                    if($d==0){
                                        echo "<tr><td colspan='2'>Maaf Data Yang anda cari tidak ada</td></tr>";
                                    }else{
                                    $hasil2= $this->db->query("SELECT * from pembayaran inner join paket on pembayaran.id_paket=paket.id_paket inner join client on pembayaran.id_client=client.id_client where year(tgl_pem)='$tahun' AND status=2");
                                    $start1=0;
                                    $total=0;
                                    foreach ($hasil2->result() as $pembayaran1)
                                    {
                                        ?>
                                    <tr>
                                        <td class="p-0 text-center">
                                        <?php echo ++$start1 ?>
                                        </td>
                                        <td><?php echo $pembayaran1->id_pem ?></td>
                                        <td><?php echo $pembayaran1->tgl_pem ?></td>
                                        <td><?php echo $pembayaran1->nama_lengkap ?></td>
                                        <td><?php  $total_a = $this->db->query("SELECT * FROM paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$pembayaran1->id_paket' ");
                        foreach($total_a->result() as $total_a){ echo $pembayaran1->bandwith.' ( '.$total_a->nama_jp.' )'; } ?></td>
                                        <td><?php echo $pembayaran1->bulan ?></td>
                                        <td>Rp.<?= number_format($pembayaran1->total_bayar) ;?></td>
                                        
                                    </tr>
                                    <?php
                                    $total += $pembayaran1->total_bayar+0;
                                    }
                                    ?>
                                    <tr>
                                        <th colspan="4"><center>Total Pembayaran</center></th>
                                        <th colspan="3">Rp.<?= number_format($total) ;?></th>
                                    </tr>
                                    </table>
                                </div>
                                </div>
                                <div class="card-footer text-left">
                                <?php echo anchor(site_url('pemasukan/word_tahun/'.$tahun), 'Word', 'class="btn btn-primary"'); ?>
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

             <!-- tampilan awal -->
                    <?php } }else{?>
                    <h5><center>Data Grafik Semua Pemasukan</center></h5>
                    <canvas id="myChart"></canvas>
                    
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Pemasukan</h4>
                    
                  </div>
                  <div id="message">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                        <th>No</th>
                        <th>ID Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Nama Client</th>
                        <th>Nama Paket</th>
                        <th>Periode</th>
                        <th>Total Bayar</th>
                        </tr><?php
                        $total = 0;
                        $hasil4= $this->db->query("SELECT * from pembayaran");
                        $f=$hasil4->num_rows();
                        if($f==0){
                        echo "<tr><td colspan='2'><center>Maaf Data Yang anda cari tidak ada</center></td></tr>";
                        }else{
                        $total=0;
                        $pembayaran_data= $this->db->query("SELECT * from pembayaran inner join paket on pembayaran.id_paket=paket.id_paket inner join client on pembayaran.id_client=client.id_client where status=2");
                        foreach ($pembayaran_data->result() as $pembayaran)
                        {
                            ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                          <td><?php echo $pembayaran->id_pem ?></td>
                          <td><?php echo $pembayaran->tgl_pem ?></td>
                          <td><?php echo $pembayaran->nama_lengkap ?></td>
                          <td><?php $total_c = $this->db->query("SELECT * FROM paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$pembayaran->id_paket' ");
                        foreach($total_c->result() as $total_c){echo $pembayaran->bandwith.' ( '.$total_c->nama_jp.' )'; } ?></td>
                          <td><?php echo $pembayaran->bulan ?></td>
                            <td>Rp.<?= number_format($pembayaran->total_bayar);?></td>
                          
                        </tr>
                        <?php
                        $total += $pembayaran->total_bayar+0;
                        }
                        ?>
                        <tr>
                          <th colspan="4"><center>Total Pemasukan</center></th>
                          <th colspan="3">Rp.<?= number_format($total) ;?></th>
                      </tr>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-left">
                  <?php echo anchor(site_url('pemasukan/word'), 'Word', 'class="btn btn-primary"'); ?>
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