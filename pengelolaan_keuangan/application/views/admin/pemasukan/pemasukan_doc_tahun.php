<!doctype html>
<html>
    <head>
        <title>Rekap Pemasukan</title>
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
        <h2><center>Rekap Pemasukan <?php echo $id ;?></center></h2>
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
            $hasil2= $this->db->query("SELECT * from pembayaran inner join paket on pembayaran.id_paket=paket.id_paket inner join client on pembayaran.id_client=client.id_client where year(tgl_pem)='$id' AND status=2");
            $total=0;
            $start=0;
            foreach ($hasil2->result() as $pembayran)
            {
                ?>
                <tr>
		                <td><?php echo ++$start ?></td>
		                <td><?php echo $pembayaran->id_pem ?></td>
                        <td><?php echo $pembayaran->tgl_pem ?></td>
                        <td><?php echo $pembayaran->nama_lengkap ?></td>
                        <td><?php echo $pembayaran->nama ?></td>
                        <td><?php echo $pembayaran->bulan ?></td>
                        <td>Rp.<?= number_format($pembayaran->total_bayar);?></td>
                </tr>
                <?php
                 $total += $pembayaran->total_bayar+0;
            }
            ?>
            <tr>
                          <th colspan="4"><center>Total Pengeluaran</center></th>
                          <th colspan="3">Rp.<?= number_format($total) ;?></th>
                      </tr>
        </table>
    </body>
</html>