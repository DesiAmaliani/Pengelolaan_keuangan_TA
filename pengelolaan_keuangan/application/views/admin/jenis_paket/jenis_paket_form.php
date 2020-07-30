 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Jenis Paket</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Jenis Paket</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="varchar">Nama Jp <?php echo form_error('nama_jp') ?></label>
                        <input type="text" class="form-control" name="nama_jp" id="nama_jp" placeholder="Nama Jp" value="<?php echo $nama_jp; ?>" />
                    </div>
                    <input type="hidden" name="id_jp" value="<?php echo $id_jp; ?>" /> 
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/jenis_paket') ?>" class="btn btn-default">Cancel</a>
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
