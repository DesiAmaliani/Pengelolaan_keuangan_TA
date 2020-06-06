
 <!-- Main Content -->
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Tagihan</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Table Tagihan</h4>
                    <div class="card-header-form">

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
                        <th>Nama Client</th>
                        <th>Paket</th>
                        <th>Bulan</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                        <!-- site_url('tagihan/create') -->
                        <th><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                          <i class="fas fa-pencil-ruler fa-sm fa-fw mr-2 text-gray-400"></i>
                          Tambah Tagihan
                        </a><?php //echo anchor(site_url('#'),'Tambah Tagihan', 'class="btn btn-primary data-toggle="modal" data-target="#logoutModal""'); ?></th>
                        </tr><?php
                            foreach ($pembayaran_data as $pembayaran)
                            {
                                ?>
                                <tr>
                            <td width="80px"><?php echo ++$start ?></td>
                            <td><?php echo $pembayaran->id_client ?></td>
                            <td><?php echo $pembayaran->id_paket ?></td>
                            <td><?php echo $pembayaran->bulan ?></td>
                            <td><?php echo $pembayaran->total_bayar ?></td>
                            <td><?php echo $pembayaran->status ?></td>
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
      <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih paket terlebih dahulu
        <div class="form-group">
                      <select class="form-control" name="id_paket" value="<?php echo $id_paket; ?>">
                      <?php
                        $paket = $this->db->query("SELECT * FROM paket");
                        foreach($paket->result() as $peng){?>
                        <option value="<?php echo $peng->id_paket; ?>"><?php echo $peng->nama; ?></option>
                        <?php
                        }
                      ?>
                      </select>
                    </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo site_url('admin/logout') ?>">Yes</a>
        </div>
      </div>
    </div>
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
