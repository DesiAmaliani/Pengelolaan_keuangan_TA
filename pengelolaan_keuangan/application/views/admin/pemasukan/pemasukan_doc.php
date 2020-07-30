<!doctype html>
<html>
    <head>
        <title>Rekap Semua Pemasukan</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2><center>Rekap Semua Pemasukan</center></h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                        <th>No</th>
                        <th>ID Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Nama Client</th>
                        <th>Nama Paket</th>
                        <th>Periode</th>
                        <th>Total Bayar</th>
		
            </tr><?php
            $total=0;
            $pembayaran_data= $this->db->query("SELECT * from pembayaran inner join paket on pembayaran.id_paket=paket.id_paket inner join client on pembayaran.id_client=client.id_client where status=2");
            foreach ($pembayaran_data->result() as $pembayaran)
            {
                ?>
                <tr>
		                <td><?php echo ++$start ?></td>
		                <td><?php echo $pembayaran->id_pem ?></td>
                        <td><?php echo $pembayaran->tgl_pem ?></td>
                        <td><?php echo $pembayaran->nama_lengkap ?></td>
                        <td><?php $total_a = $this->db->query("SELECT * FROM paket inner join jenis_paket on paket.id_jp=jenis_paket.id_jp where id_paket='$pembayaran->id_paket' ");
                        foreach($total_a->result() as $total_a){ echo $pembayaran->bandwith.' ( '.$total_a->nama_jp.' )'; } ?></td>
                        <td><?php echo $pembayaran->bulan ?></td>
                        <td>Rp.<?= number_format($pembayaran->total_bayar);?></td>	
                </tr>
                <?php
                 $total += $pembayaran->total_bayar+0;
            }
            ?>
            <tr>
                          <th colspan="4"><center>Total Pemasukan</center></th>
                          <th colspan="3">Rp.<?= number_format($total) ;?></th>
                      </tr>
        </table>
    </body>
</html>