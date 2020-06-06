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
        <h2 style="margin-top:0px">Pembayaran Read</h2>
        <table class="table">
	    <tr><td>Tgl Pem</td><td><?php echo $tgl_pem; ?></td></tr>
	    <tr><td>Id Client</td><td><?php echo $id_client; ?></td></tr>
	    <tr><td>Total Bayar</td><td><?php echo $total_bayar; ?></td></tr>
	    <tr><td>Bukti Pem</td><td><?php echo $bukti_pem; ?></td></tr>
	    <tr><td>Id Paket</td><td><?php echo $id_paket; ?></td></tr>
	    <tr><td>Bulan</td><td><?php echo $bulan; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pembayaran') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>