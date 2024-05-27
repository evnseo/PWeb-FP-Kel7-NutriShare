<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>
<html>
<head>
  <title>Data Donasi</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Data Donasi</h2>
			<h4>List Dana Donasi</h4>
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Donatur</th>
                                                <th>Email</th>
                                                <th>Nomor Telepon</th>
                                                <th>Jumlah</th>
                                                <th>Metode Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambilsemuadatadonasi = mysqli_query($conn, "select * from tbl_donasi");
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($ambilsemuadatadonasi)) {
                                                $id = $data['id_donasi'];
                                                $nama = $data['nama_donatur'];
                                                $email = $data['email_donatur'];
                                                $telp = $data['notelp_donatur'];
                                                $jumlah = $data['jumlah'];
                                                $metode = $data['metode_bayar'];
                                            ?>  
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?php echo $nama;?></td>
                                                <td><?php echo $email;?></td>
                                                <td><?php echo $telp;?></td>
                                                <td><?php echo $jumlah;?></td>
                                                <td><?php echo $metode;?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>