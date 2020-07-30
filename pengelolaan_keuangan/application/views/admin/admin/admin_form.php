 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Admin</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Admin</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Username <?php echo form_error('username') ?></label>
                        <?php
                    if($button=="Update"){?>
                    <input type="text" class="form-control" readonly name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                    <?php
                    }else{?>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                        <?php 
                    }
                    ?>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Password <?php echo form_error('password') ?></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                    </div>
                    <div class="form-group" id="only-number">
                        <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
                    </div>
                    <div class="form-group" id="only-number">
                        <label for="varchar">Email<?php echo form_error('email') ?></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="No Hp" value="<?php echo $email; ?>" />
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                      <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                    </div>
                    <?php
                    if($button=="Update"){?>
                    <div class="form-group">
                        <label for="varchar">Foto <?php echo form_error('foto') ?></label>
                        <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
                    </div>
                    <img src="<?php echo base_url(); ?>tampilan/profil/admin/<?php echo $foto ?>" alt="logo" width="80" class="shadow-light rounded-circle">
                    <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" />
                      <?php
                    }else{?>
                    <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>" />
                    <?php 
                    }
                    ?>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/admin') ?>" class="btn btn-default">Cancel</a>
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
