<!doctype html>
<html>
    <head>
        <title>Rekap Semua Pengeluaran</title>
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
        <h2><center>Rekap Semua Pengeluaran</center></h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>ID Pengeluaran</th>
                <th>Tanggal Pengeluaran</th>
                <th>Keterangan</th>
                <th>Total Pengeluaran</th>
		
            </tr><?php
            $total=0;
            foreach ($pengeluaran_data as $pengeluaran)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $pengeluaran->id_peng ?></td>
		      <td><?php echo $pengeluaran->tgl_peng ?></td>
		      <td><?php echo $pengeluaran->ket ?></td>
		      <td><?php echo "Rp ".number_format($pengeluaran->total_peng); ?></td>	
                </tr>
                <?php
                 $total += $pengeluaran->total_peng+0;
            }
            ?>
            <tr>
                          <th colspan="4"><center>Total Pengeluaran</center></th>
                          <th colspan="3">Rp.<?= number_format($total) ;?></th>
                      </tr>
        </table>
    </body>
</html>