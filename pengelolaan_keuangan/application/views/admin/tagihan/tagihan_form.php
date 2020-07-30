 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Tagihan</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Tagihan</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="int">Nama Client <code>*(<i>Wajib diisi</i>)</code> <?php echo form_error('id_client') ?></label>
                        <?php
                        $client = $this->db->query("SELECT * FROM client where id_paket='$id' and status_client=1");
                        foreach($client->result() as $peng){?>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" name="id_client[]" value="<?php echo $peng->id_client; ?>">
                        <label class="form-check-label" for="defaultCheck1">
                          <?php echo $peng->nama_lengkap ;?>
                        </label>
                      </div>
                        <?php } ?>
                        <!-- <input type="text" class="form-control" name="id_client" id="id_client" placeholder="Id Client" value="<?php echo $id_client; ?>" /> -->
                    </div>
                    <div class="form-group">
                      <?php $total = $this->db->query("SELECT * FROM paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$id' ");
                        foreach($total->result() as $total){?>
                        <label for="int">Total Bayar <?php echo form_error('total_bayar') ?></label>
                        <input type="text" class="form-control" name="total_bayar" id="total_bayar" placeholder="Total Bayar" readonly value="<?php echo $total->harga; ?>" />
                        
                      </div>
                    <div class="form-group">
                        <label for="int">Paket <?php echo form_error('id_paket') ?></label>
                        <input type="text" class="form-control" name="id_paket" id="id_paket" placeholder="Id Paket" readonly value="<?php echo $total->id_paket; ?>" />
                        <label for="int" style="color:blue;"><i><?php echo $total->bandwith.' ( '.$total->nama_jp.' )';?></i></label>
                        <?php } ?>
                      </div>
                    <div class="form-group">
                        <label for="varchar">Periode <?php echo form_error('bulan') ?></label>
                        <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan" readonly value="<?php echo date('M/Y'); ?>" />
                    </div>
                        <input type="hidden" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo 0; ?>" />
                        <input type="hidden" class="form-control" name="status_notif" id="status_notif" placeholder="Status" value="<?php echo 0; ?>" />
                    <input type="hidden" name="id_pem" value="<?php echo $id_pem; ?>" /> 
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/tagihan') ?>" class="btn btn-default">Cancel</a>
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
 