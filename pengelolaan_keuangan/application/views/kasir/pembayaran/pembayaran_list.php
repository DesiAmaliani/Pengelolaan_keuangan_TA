
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Transaksi</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Transaksi</h4>
                    <div class="card-header-form">

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
                        <th>Nama Client</th>
                        <th>Nama Paket</th>
                        <th>Periode</th>
                        <th>Jatuh Tempo</th>
                        <th>Total Bayar</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <!-- site_url('tagihan/create') -->
                        <th>
                        </tr>
                        <?php
                        $pembayaran_data= $this->db->query("SELECT * FROM pembayaran inner join paket on pembayaran.id_paket=paket.id_paket inner join client on pembayaran.id_client=client.id_client");
                            foreach ($pembayaran_data->result() as $pembayaran)
                            {
                                ?>
                                <tr>
                            <td width="80px"><?php echo ++$start ?></td>
                            <td><?php echo $pembayaran->nama_lengkap ?></td>
                            <td><?php $total = $this->db->query("SELECT * FROM paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$pembayaran->id_paket' ");
                        foreach($total->result() as $total){ echo $pembayaran->bandwith.' ( '.$total->nama_jp.' )'; } ?></td>
                            <td><?php echo $pembayaran->bulan ?></td>
                            <td><?php echo $pembayaran->jatuh_temp ?></td>
                            <td>Rp <?php echo number_format($pembayaran->total_bayar); ?></td>
			                <td><?php echo $pembayaran->tgl_pem ?></td>
                            <td><img src="<?php echo base_url(); ?>tampilan/pembayaran/<?php echo $pembayaran->bukti_pem ?>" alt="(Belum ada foto)" width="80" class="shadow-light"></td>
                            <td><div class="badge badge-primary"><?php 
                            if($pembayaran->status==0){
                            echo "Belum Bayar"; 
                            echo "<td>".anchor(site_url('pembayaran_kasir/bayar/'.$pembayaran->id_pem),'Bayar')."</td>"; 
                            }elseif($pembayaran->status==1){
                                echo "Menunggu Konfirmasi";
                                echo anchor(site_url('pembayaran_kasir/konfirmasi/'.$pembayaran->id_pem),'Konfirmasi','onclick="javasciprt: return confirm(\'Are You Sure ?\')"')." | "; 
                                echo anchor(site_url('pembayaran_kasir/tolak/'.$pembayaran->id_pem),'Tolak','onclick="javasciprt: return confirm(\'Are You Sure ?\')"')."</td>"; 
                            }elseif($pembayaran->status==2){
                                echo "Sudah dikonfirmasi";
                                echo "<td>".anchor(site_url('pembayaran_kasir/invoice/'.$pembayaran->id_pem),'Invoice')."</td>"; 
                            }else{
                                echo "Tidak Dikonfirmasi";}?></div></td>
                        </tr>
                                <?php
                            }
                            ?>
                      </table>
                    </div>
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
