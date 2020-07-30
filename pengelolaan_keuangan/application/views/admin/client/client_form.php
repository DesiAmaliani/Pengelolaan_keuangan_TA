 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Client</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Client</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="int">Paket <?php echo form_error('id_paket') ?></label>
                       <select class="form-control" name="id_paket" value="<?php echo $id_paket;?>">
                        <?php $jpaket = $this->db->query("select * from paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$id_paket' ");
                        foreach($jpaket->result() as $paket){?>
                        <option value="<?php echo $id_paket;?>"><?php echo $paket->nama_jp.' ( '.$paket->bandwith.' )';?></option>
                        <?php } ?>
                          <?php
                          $jp=$this->db->query("select * from paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp");
                          foreach ($jp->result() as $jenis) {?>
                          <option value="<?php echo $jenis->id_paket;?>"><?php echo $jenis->nama_jp.' ( '.$jenis->bandwith.' )';?></option>
                          <?php
                          }
                          ?>
                      </select>
                      </div>
                    <div class="form-group">
                        <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Username <?php echo form_error('username') ?></label>
                        <?php
                    if($button=="Update"){?>
                    <input type="text" readonly class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
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
                    <div class="form-group">
                      <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                      <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Bergabung <?php echo form_error('tgl_bergabung') ?></label>
                        <?php if($button=="Update"){?>
                        <input type="text" readonly class="form-control" name="tgl_bergabung" id="tgl_bergabung" placeholder="Tgl Bergabung" value="<?php echo $tgl_bergabung; ?>" />
                        <?php }else{?>
                        <input type="text" readonly class="form-control" name="tgl_bergabung" id="tgl_bergabung" placeholder="Tgl Bergabung" value="<?php echo date("Y/m/d"); ?>" />
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Latitude <?php echo form_error('latitude') ?></label>
                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Longitude <?php echo form_error('longitude') ?></label>
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Jatuh Tempo <?php echo form_error('jatuh_tempo') ?></label>
                        <select class="form-control" id="jatuh_tempo" name="jatuh_tempo" value="<?php echo $jatuh_tempo;?>">
                        <option value="<?php echo $jatuh_tempo;?>"><?php echo $jatuh_tempo;?></option>
                          <?php
                          for ($i=1; $i <= 31; $i++) { ?>
                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                          <?php
                          }
                          ?>
                        
                      </select>
                    </div>
                    <?php
                    if($button=="Update"){?>
                    <div class="form-group">
                        <label for="varchar">Foto <?php echo form_error('foto') ?></label>
                        <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
                    </div>
                    <img src="<?php echo base_url(); ?>tampilan/profil/<?php echo $foto ?>" alt="logo" width="80" class="shadow-light rounded-circle">
                    <input type="hidden" name="id_client" value="<?php echo $id_client; ?>" />
                      <?php
                    }else{?>
                    <input type="hidden" name="id_client" value="<?php echo $id_client; ?>" />
                    <?php 
                    }
                    ?>
                    <div class="form-group">
                        <label for="enum">Status Client <?php echo form_error('status_client') ?></label>
                        <select class="form-control" name="status_client" value="<?php echo $status_client?>">
                        
                          <option value="1">Aktif</option>
                          <option value="2">Non Aktif</option>
                      </select>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/client') ?>" class="btn btn-default">Cancel</a>
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
  