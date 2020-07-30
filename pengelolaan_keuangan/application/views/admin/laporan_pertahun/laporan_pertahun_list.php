
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
                            <button class="btn btn-primary" type="submit" style="padding:8px 16px;"> <i class="fas fa-search"></i></button>
                        </div>
                        </form>
                    </div>
                    
                </div>
                </div>
            </section>
            <?php
                    $proses=$this->input->get('proses',TRUE);
                    $tahun=$this->input->post('tahun',TRUE);
                    if($proses=='cetak'){
                  ?> 
             <div class="row">
                  <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                      <h4>A. <?php echo $tahun;  ?></h4></div>
                      <div class="card-header">
                      <h4>Pemasukan</h4></div>
                      <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                        <th>No</th>
                        <th>ID Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Nama Client</th>
                        <th>Nama Paket</th>
                        <th>Total Bayar</th>
                        </tr>
                        <?php
                       $total_pem=0;
                       $pembayaran_data= $this->db->query("SELECT * from pembayaran inner join paket on pembayaran.id_paket=paket.id_paket inner join client on pembayaran.id_client=client.id_client where status=2 AND year(tgl_pem)='$tahun'");
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
                          <td>Rp.<?= number_format($pembayaran->total_bayar);?></td>
                        </tr>
                        <?php
                        $total_pem += $pembayaran->total_bayar+0;
                        }
                        ?>
                        <tr>
                          <th colspan="5"><center>Total Pemasukan</center></th>
                          <th colspan="2">Rp.<?= number_format($total_pem) ;?></th>
                      </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                      <h4>Pengeluaran</h4></div>
                      <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                        <th>No</th>
                        <th>ID Pengeluaran</th>
                        <th>Tanggal Pengeluaran</th>
                        <th>Keterangan</th>
                        <th>Total Pengeluaran</th>
                        </tr>
                        <?php
                       $total_p=0;
                       $pengeluaran_data= $this->db->query("SELECT * from pengeluaran where year(tgl_peng)='$tahun'");
                       foreach ($pengeluaran_data->result() as $pengeluaran)
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
                         </tr>
                         <?php
                        $total_p += $pengeluaran->total_peng+0;
                        }
                        ?>
                        <tr>
                          <th colspan="4"><center>Total Pengeluaran</center></th>
                          <th colspan="3">Rp.<?= number_format($total_p) ;?></th>
                       </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  </div>       
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                      </div>
                      <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                       <tr>
                          <th colspan="4"><center>Sisa Saldo</center></th>
                          <?php $total= $total_pem - $total_p; ?>
                          <th colspan="3">Rp.<?= number_format($total) ;?></th>
                       </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  </div>
                  </div>
                  <?php }else{ ?>
                  <?php } ?>
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
