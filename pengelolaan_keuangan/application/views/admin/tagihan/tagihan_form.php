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
                        <label for="int">Nama Client <?php echo form_error('id_client') ?></label>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" name="id_client" value="<?php echo $id_client; ?>">
                        <label class="form-check-label" for="defaultCheck1">
                          Checkbox 1
                        </label>
                      </div>
                        <!-- <input type="text" class="form-control" name="id_client" id="id_client" placeholder="Id Client" value="<?php echo $id_client; ?>" /> -->
                    </div>
                    <div class="form-group">
                        <label for="int">Total Bayar <?php echo form_error('total_bayar') ?></label>
                        <input type="text" class="form-control" name="total_bayar" id="total_bayar" placeholder="Total Bayar" value="<?php echo $total_bayar; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Paket <?php echo form_error('id_paket') ?></label>
                        <input type="text" class="form-control" name="id_paket" id="id_paket" placeholder="Id Paket" value="<?php echo $id_paket; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Bulan <?php echo form_error('bulan') ?></label>
                        <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan" value="<?php echo $bulan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="int">Status <?php echo form_error('status') ?></label>
                        <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                    </div>
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
 