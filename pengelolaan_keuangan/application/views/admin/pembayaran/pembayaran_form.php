<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Pembayaran <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="datetime">Tgl Pem <?php echo form_error('tgl_pem') ?></label>
            <input type="text" class="form-control" name="tgl_pem" id="tgl_pem" placeholder="Tgl Pem" value="<?php echo $tgl_pem; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Client <?php echo form_error('id_client') ?></label>
            <input type="text" class="form-control" name="id_client" id="id_client" placeholder="Id Client" value="<?php echo $id_client; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Total Bayar <?php echo form_error('total_bayar') ?></label>
            <input type="text" class="form-control" name="total_bayar" id="total_bayar" placeholder="Total Bayar" value="<?php echo $total_bayar; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Bukti Pem <?php echo form_error('bukti_pem') ?></label>
            <input type="text" class="form-control" name="bukti_pem" id="bukti_pem" placeholder="Bukti Pem" value="<?php echo $bukti_pem; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Paket <?php echo form_error('id_paket') ?></label>
            <input type="text" class="form-control" name="id_paket" id="id_paket" placeholder="Id Paket" value="<?php echo $id_paket; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Bulan <?php echo form_error('bulan') ?></label>
            <input type="text" class="form-control" name="bulan" id="bulan" placeholder="Bulan" value="<?php echo $bulan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <input type="hidden" name="id_pem" value="<?php echo $id_pem; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pembayaran') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>