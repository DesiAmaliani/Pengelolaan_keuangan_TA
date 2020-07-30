 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form Info IP Client</h1>
          </div>
          <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $button ?> Info IP Client</h4>
                  </div>
                  <div class="card-body">
                  <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                        <label for="int">Nama Client <?php echo form_error('id_client') ?></label>
                        <select class="form-control" name="id_client">
                        <?php $client = $this->db->query("SELECT * FROM client where id_client='$id_client' ");
                        foreach($client->result() as $client){?>
                        <option value="<?php echo $id_client;?>"><?php echo $client->nama_lengkap;?></option>
                        <?php } ?>
                          <?php
                          $jclient=$this->db->query("select * from client where status_client=1");
                          foreach ($jclient->result() as $jclient) {?>
                          <option value="<?php echo $jclient->id_client;?>"><?php echo $jclient->nama_lengkap;?></option>
                          <?php
                          }
                          ?>
                      </select>
                        <!-- <input type="text" class="form-control" name="id_client" id="id_client" placeholder="Id Client" value="<?php echo $id_client; ?>" /> -->
                    </div>
                    <div class="form-group">
                        <label for="varchar">Username Pppoe <?php echo form_error('user_pppoe') ?></label>
                        <input type="text" class="form-control" name="user_pppoe" id="user_pppoe" placeholder="User Pppoe" value="<?php echo $user_pppoe; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Password Ppoe <?php echo form_error('pass_ppoe') ?></label>
                        <input type="text" class="form-control" name="pass_ppoe" id="pass_ppoe" placeholder="Pass Ppoe" value="<?php echo $pass_ppoe; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">IP Radio <?php echo form_error('ip_radio') ?></label>
                        <input type="text" class="form-control" name="ip_radio" id="ip_radio" placeholder="Ip Radio" value="<?php echo $ip_radio; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Radio <?php echo form_error('nama_radio') ?></label>
                        <input type="text" class="form-control" name="nama_radio" id="nama_radio" placeholder="Nama Radio" value="<?php echo $nama_radio; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">IP Router <?php echo form_error('ip_router') ?></label>
                        <input type="text" class="form-control" name="ip_router" id="ip_router" placeholder="Ip Router" value="<?php echo $ip_router; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Username / Password Router <?php echo form_error('user_paas_router') ?></label>
                        <input type="text" class="form-control" name="user_paas_router" id="user_paas_router" placeholder="User Paas Router" value="<?php echo $user_paas_router; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Merk Router <?php echo form_error('merk_router') ?></label>
                        <input type="text" class="form-control" name="merk_router" id="merk_router" placeholder="Merk Router" value="<?php echo $merk_router; ?>" />
                    </div>
                    <input type="hidden" name="id_infoip" value="<?php echo $id_infoip; ?>" /> 
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	                <a href="<?php echo site_url('admin/info_ip_client') ?>" class="btn btn-default">Cancel</a>
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
