
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Client</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Client</h4>
                    <div class="card-header-form">
                    <form action="<?php echo site_url('client/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search"  name="q" value="<?php echo $q; ?>">
                          <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <?php
                                }
                            ?>
                          <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>No Hp</th>
                            <th>Alamat</th>
                            <th>Tanggal Bergabung</th>
                            <th>Titik Koordinat</th>
                            <th>Jatuh Tempo</th>
                            <th>Foto</th>
                            <th>Paket</th>
                            <th>Status Client</th>
                        <th><?php echo anchor(site_url('client/create'),'Create', 'class="btn btn-primary"'); ?></th>
                        </tr><?php
                            foreach ($client_data as $client)
                            {
                                ?>
                        <tr>
                          <td class="p-0 text-center">
                          <?php echo ++$start ?>
                          </td>
                            <td><?php echo $client->nama_lengkap ?></td>
                            <td><?php echo $client->username ?></td>
                            <td><?php echo $client->no_hp ?></td>
                            <td><?php echo $client->alamat ?></td>
                            <td><?php echo $client->tgl_bergabung  ?></td>
                            <td>
                            <?php 
                            echo anchor(site_url('client/lokasi/'.$client->id_client),'Lokasi'); 
                           ?></td>
                            <td><?php echo $client->jatuh_tempo ?></td>
                          <td>
                         <img src="<?php echo base_url(); ?>tampilan/profil/client/<?php echo $client->foto ?>" alt="logo" width="80" class="shadow-light rounded-circle"></td>
                         <td><?php 
                         $paket=$this->db->query("select * from paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$client->id_paket'");
                         foreach ($paket->result() as $paket) {
                            echo $paket->nama_jp."( ".$paket->bandwith." )";
                         }
                         ?></td>
                          <td><?php if($client->status_client==1){ ?>
                        <form action="<?php echo site_url('client/status'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                          <label class="custom-switch">
                          <input type="hidden" name="status_client" value="2">
                          <input type="hidden" name="id_client" value="<?php echo $client->id_client; ?>" />
                          <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                          <span class="custom-switch-description">Aktif</span>
                        </label>
                        </form>
                          <?php }else{ ?>
                        <form action="<?php echo site_url('client/status'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                          <label class="custom-switch">
                          <input type="hidden" name="status_client" value="1">
                          <input type="hidden" name="id_client" value="<?php echo $client->id_client; ?>" />
                          <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button>
                          <span class="custom-switch-description">Non Aktif</span>
                        </label>
                        </form>
                          <?php } ?>
                        </td>
                          <td><?php 
                            echo anchor(site_url('client/read/'.$client->id_client),'Read'); 
                            echo ' | '; 
                            echo anchor(site_url('client/update/'.$client->id_client),'Update'); 
                            echo ' | '; 
                            echo anchor(site_url('client/delete/'.$client->id_client),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                            ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                  <?php echo $pagination ?>
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
