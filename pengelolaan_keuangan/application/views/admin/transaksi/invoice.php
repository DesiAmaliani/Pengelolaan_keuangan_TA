<div id="app">
    <section class="section">
    <div class="container mt-5">
          <!-- <div class="section-body"> -->
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <center><h2>STRUK BUKTI PEMBAYARAN <br>PT. CUPLIK MEDIA CENTER</h2></center>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-4">
                        <address>
                        <strong><?php echo $user['id_kasir'] ;?>/<?php echo $tgl_pem; ?>/<?php echo $user['nama_lengkap'] ;?></strong><br>
                            No. Pembayaran<br>
                            No. Pelanggan<br>
                            Nama Pelanggan<br>
                            Periode<br>
                            Paket<br>
                            Tagihan<br>
                            Total Bayar<br>
                            Tanggal Pembayaran
                        </address>
                      </div>
                      <div class="col-md-4">
                        <address>
                          <br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :<br>
                            :
                        </address>
                      </div>
                      <div class="col-md-4 text-md-right">
                        <address>
                          <br>
                          <?php echo $id_pem ;?><br>
                          <?php echo $id_client; ?><br>
                          <?php $client = $this->db->query("SELECT * FROM client where id_client='$id_client' ");
                          foreach($client->result() as $client){  echo $client->nama_lengkap; }?><br>
                          <?php echo $bulan; ?><br>
                          <?php $paket = $this->db->query("SELECT * FROM paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$id_paket' ");
                          foreach($paket->result() as $paket){  echo $paket->bandwith.' ( '.$paket->nama_jp.' )'; }?><br>
                          Rp <?php echo number_format($total_bayar);?><br>
                          Rp <?php echo number_format($total_bayar);?><br>
                          <?php echo $tgl_pem;?><br>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
              <div class="row mt-4">
                      <div class="col-lg-12">
                        <p align="center" class="section-lead"><b>STRUK INI MERUPAKAN BUKTI PEMBAYARAN YANG SAH. HARAP DISIMPAN<br> TERIMA KASIH</b></p>
                      </div>
                  </div>

                
              <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  <a href="<?php echo site_url('kasir/pembayaran') ?>" button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</a>
                </div>
                <a href="<?php echo site_url('pembayaran_kasir/invoice_print/'.$id_pem);?>" button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</a>
              </div>
            </div>
          </div>
        </section>
      </div>
      