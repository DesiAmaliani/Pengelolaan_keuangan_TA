<i data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg "><i class="far fa-bell"></i>
<?php 
  $query = $this->db->query("SELECT * FROM pembayaran WHERE status_notif=1");
  $s=$query->num_rows();
  if($s==TRUE){
?>
<span class="badge badge-danger badge-counter count"><a width="5">
<?php 
  echo $s;
?></a></span><?php }else{
                      
}?></i>
<div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <!-- <a href="#">Mark All As Read</a> -->
                </div>
              </div>
              <?php $notif = $this->db->query("SELECT * FROM pembayaran WHERE status_notif=1");
              $notifs=$notif->num_rows(); 
              if($notifs==TRUE){
                $qu1 = $this->db->query("SELECT * FROM pembayaran inner join paket on pembayaran.id_paket=paket.id_paket inner join client on pembayaran.id_client=client.id_client WHERE status_notif=1");
                foreach ($qu1->result() as $j){
              ?>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="<?php echo site_url('transaksi/notif/'.$j->id_pem) ?>" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="dropdown-item-desc">
                  <div class="time text-primary"><?php echo $j->tgl_pem ; ?></div>
                  <span class="font-weight-bold">
                    Pembayaran Perbulan <?php echo $j->bulan; ?></span>
                    <div class="time text-primary"><?php echo $j->nama_lengkap.', Rp '.number_format($j->total_bayar) ; ?></div>
                  </div>
                </a>
                <?php } 
              } ?>
              </div>
               
                  
              <!-- <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div> -->
            </div>