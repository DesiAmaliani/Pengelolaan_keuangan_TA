 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Paket</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Paket</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="varchar">Jenis Paket <?php echo form_error('id_jp') ?></label>
                        <select class="form-control" name="id_jp">
                        <?php $jpaket = $this->db->query("SELECT * FROM jenis_paket where id_jp='$id_jp' ");
                        foreach($jpaket->result() as $paket){?>
                        <option value="<?php echo $id_jp;?>"><?php echo $paket->nama_jp;?></option>
                        <?php } ?>
                          <?php
                          $jp=$this->db->query("select * from jenis_paket");
                          foreach ($jp->result() as $jenis) {?>
                          <option value="<?php echo $jenis->id_jp;?>"><?php echo $jenis->nama_jp;?></option>
                          <?php
                          }
                          ?>
                      </select>
                        </div>
                    <div class="form-group">
                        <label for="varchar">Bandwith <?php echo form_error('bandwith') ?></label>
                        <input type="text" class="form-control" name="bandwith" id="bandwith" placeholder="Bandwith" value="<?php echo $bandwith; ?>" />
                    </div>
                    <div class="form-group" id="only-number">
                        <label for="int">Harga <?php echo form_error('harga') ?></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            Rp
                          </div>
                        </div>
                        <input type="text" class="form-control currency" name="harga" id="no_hp" placeholder="Harga" value="<?php echo $harga; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kapasitas Pengguna <?php echo form_error('kap_peng') ?></label>
                        <input type="text" class="form-control" name="kap_peng" id="kap_peng" placeholder="Kapasitas Pengguna" value="<?php echo $kap_peng; ?>" />
                    </div>
                    <input type="hidden" name="id_paket" value="<?php echo $id_paket; ?>" /> 
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/paket') ?>" class="btn btn-default">Cancel</a>
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
