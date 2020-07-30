 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Data Bts</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Data Bts</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="varchar">Nama Bts <?php echo form_error('nama_bts') ?></label>
                        <input type="text" class="form-control" name="nama_bts" id="nama_bts" placeholder="Nama Bts" value="<?php echo $nama_bts; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="alamat_bts">Alamat Bts <?php echo form_error('alamat_bts') ?></label>
                        <textarea class="form-control" rows="3" name="alamat_bts" id="alamat_bts" placeholder="Alamat Bts"><?php echo $alamat_bts; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Longitude <?php echo form_error('longitude') ?></label>
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Latitude <?php echo form_error('latitude') ?></label>
                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" />
                    </div>
                    <input type="hidden" name="id_bts" value="<?php echo $id_bts; ?>" /> 
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/data_bts') ?>" class="btn btn-default">Cancel</a>
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
