 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Pengeluaran</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Pengeluaran</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="date">Tanggal Pengeluaran <?php echo form_error('tgl_peng') ?></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-calendar"></i>
                          </div>
                        </div>
                        <?php
                         if($button=="Update"){?>
                         <input readonly type="text" class="form-control daterange-cus" name="tgl_peng" id="tgl_peng" placeholder="Tgl Peng" value="<?php echo $tgl_peng ?>" />
                          <?php
                         }else{?>
                        <input readonly type="text" class="form-control daterange-cus" name="tgl_peng" id="tgl_peng" placeholder="Tgl Peng" value="<?php echo date("Y/m/d"); ?>" />
                        <?php 
                       }
                    ?>
                      </div>
                    </div>
                    <div class="form-group" id="only-number">
                        <label for="int">Total Pengeluaran <code>*(<i>Wajib diisi</i>)</code> <?php echo form_error('total_peng') ?></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            Rp
                          </div>
                        </div>
                        <input type="text" class="form-control currency" name="total_peng" id="no_hp" placeholder="Total Peng" value="<?php echo $total_peng; ?>" />
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan <code>*(<i>Wajib diisi</i>)</code> <?php echo form_error('ket') ?></label>
                        <textarea class="form-control" rows="3" name="ket" id="ket" placeholder="Ket"><?php echo $ket; ?></textarea>
                    </div>
                    <?php
                    if($button=="Update"){?>
                    <div class="form-group">
                        <label for="varchar">Bukti Pengeluaran <?php echo form_error('bukti_peng') ?></label>
                        <input type="file" class="form-control" name="bukti_peng" id="bukti_peng" placeholder="Bukti pengeluaran" value="<?php echo $bukti_peng; ?>" />
                    </div>
                    <img src="<?php echo base_url(); ?>tampilan/pengeluaran/<?php echo $bukti_peng ?>" alt="logo" width="80" class="shadow-light rounded-circle">
                    <input type="hidden" name="id_peng" value="<?php echo $id_peng; ?>" />
                      <?php
                    }else{?>
                     <div class="form-group">
                        <label for="varchar">Bukti Pengeluaran <code>*(<i>Wajib diisi</i>)</code> <?php echo form_error('bukti_peng') ?></label>
                        <input type="file" class="form-control" name="bukti_peng" id="bukti_peng" placeholder="Bukti pengeluaran" value="<?php echo $bukti_peng; ?>" />
                    </div>
                    <input type="hidden" name="id_peng" value="<?php echo $id_peng; ?>" />
                    <?php 
                    }
                    ?>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/pengeluaran') ?>" class="btn btn-default">Cancel</a>
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
 