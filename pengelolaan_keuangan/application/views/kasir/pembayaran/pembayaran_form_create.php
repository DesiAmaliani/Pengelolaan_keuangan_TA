 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Pembayaran </h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Form Pembayaran Pemasangan Alat</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="int">Nama Client <code>*(<i>Wajib diisi</i>)</code> <?php echo form_error('id_client') ?></label>
                        <select class="form-control" name="id_client" id="id_client" placeholder="Id Client" value="<?php echo $id_client; ?>">
                        <?php $client = $this->db->query("SELECT * FROM client");
                        foreach($client->result() as $client){?>
                        <option value="<?php echo $client->id_client; ?>"><?php echo $client->nama_lengkap ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <?php $paket = $this->db->query("SELECT * FROM paket where id_paket='3' ");
                        foreach($paket->result() as $paket){?>
                        <label for="int">Total Bayar <?php echo form_error('total_bayar') ?></label>
                        <input type="text" class="form-control" name="total_bayar" id="total_bayar" placeholder="Total Bayar" readonly value="<?php echo $paket->harga; ?>" />
                        
                      </div>
                    <div class="form-group">
                        <label for="int">Paket <?php echo form_error('id_paket') ?></label>
                        <input type="text" class="form-control" name="id_paket" id="id_paket" placeholder="Id Paket" readonly value="<?php echo $paket->id_paket; ?>" />
                        <label for="int" style="color:blue;"><i><?php echo $paket->nama; ?></i></label>
                        <?php } ?>
                      </div>
                    <div class="form-group">
                        <label for="varchar">Bulan <?php echo form_error('bulan') ?></label>
                        <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan" readonly value="<?php echo date('M/Y'); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Pembayaran <?php echo form_error('tgl_pem') ?></label>
                        <input type="text" class="form-control" readonly name="tgl_pem" id="tgl_pem" placeholder="Tgl Pem" value="<?php echo date("Y/m/d"); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Bukti Pembayaran <code>*(<i>Wajib diisi</i>)</code> <?php echo form_error('bukti_pem') ?></label>
                        <input type="file" required class="form-control" name="bukti_pem" id="bukti_pem" placeholder="Bukti Pem" value="<?php echo $bukti_pem; ?>" />
                    </div>
                        <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo 2; ?>" />
                        <input type="hidden" class="form-control" name="status_notif" id="status_notif" placeholder="Status" value="<?php echo 0; ?>" />
                    <input type="hidden" name="id_pem" value="<?php echo $id_pem; ?>" /> 
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('kasir/pembayaran') ?>" class="btn btn-default">Cancel</a>
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
 