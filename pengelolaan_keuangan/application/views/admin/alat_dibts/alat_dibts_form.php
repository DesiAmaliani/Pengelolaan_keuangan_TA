 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Alat DiBts</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Alat DiBts</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="int">Nama Bts <?php echo form_error('id_bts') ?></label>
                        <select class="form-control" name="id_bts">
                          <?php
                          $jp=$this->db->query("select * from alat_dibts inner join data_bts on alat_dibts.id_bts=data_bts.id_bts");
                          foreach ($jp->result() as $alat) {?>
                          <option value="<?php echo $alat->id_bts;?>"><?php echo $alat->nama_bts;?></option>
                          <?php
                          }
                          ?>
                        
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Alat <?php echo form_error('nama_alat') ?></label>
                        <input type="text" class="form-control" name="nama_alat" id="nama_alat" placeholder="Nama Alat" value="<?php echo $nama_alat; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">IP Alat <?php echo form_error('ip_alat') ?></label>
                        <input type="text" class="form-control" name="ip_alat" id="ip_alat" placeholder="Ip Alat" value="<?php echo $ip_alat; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">SSID <?php echo form_error('ssid') ?></label>
                        <input type="text" class="form-control" name="ssid" id="ssid" placeholder="Ssid" value="<?php echo $ssid; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Frequensi <?php echo form_error('frequensi') ?></label>
                        <input type="text" class="form-control" name="frequensi" id="frequensi" placeholder="Frequensi" value="<?php echo $frequensi; ?>" />
                    </div>
                    <input type="hidden" name="id_alat" value="<?php echo $id_alat; ?>" /> 
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/alat_dibts') ?>" class="btn btn-default">Cancel</a>
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
