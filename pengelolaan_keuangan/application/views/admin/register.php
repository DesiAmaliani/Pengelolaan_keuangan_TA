<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?php echo base_url(); ?>tampilan/assets/img/logo-cuplik.PNG" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>
            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>
              <div class="card-body">
              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <form method="POST" action="<?php echo site_url('login_admin/register_add') ?>" enctype="multipart/form-data" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="frist_name">Nama Lengkap</label>
                      <input id="frist_name" required type="text" class="form-control" name="nama_lengkap" autofocus>
                    </div>

                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="username" required type="text" class="form-control" name="username">
                  </div>

                    <div class="form-group">
                      <label for="password" class="d-block">Password</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                          </div>
                        </div>
                        <input id="password" required type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      </div>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea id="alamat" required  class="form-control" name="alamat"></textarea>
                    </div>
                    <div class="form-group" id="only-number">
                      <label for="no_hp">No HP</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                          </div>
                        </div>
                        <input type="text" required  id="number" class="form-control phone-number" name="no_hp">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" required type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                          <?php echo $captcha;?>
                          </div>
                        </div>
                      <input id="captcha" required type="text" class="form-control" name="captcha">
                      <?php $wrong = $this->input->get('cap_error');
                    
                    if($wrong){?><span style="color:red;">Captcha yang kamu masukan salah, silahkan ulangi lagi</span> <?php } ?>
                    </div>
                    </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
                <div class="form-group">
                    <a href="<?php echo site_url();?>admin/" class="btn btn-primary btn-lg btn-block">
                      Login
                    </a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>