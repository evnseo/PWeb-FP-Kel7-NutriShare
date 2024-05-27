<?php

$conn = mysqli_connect('localhost','root','','db_nutrishare');

//menambah data user baru
if(isset($_POST['addnewuser'])){
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $user_type = $_POST['user_type'];

    $insert = "INSERT INTO tbl_user(nama_user, email_user, password_user, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
    if($insert){
        header('location:dashboard_admin.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_admin.php');
    }
}

//update data user
if(isset($_POST['updateuser'])){
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $user_type = $_POST['user_type'];
    $id = $_POST['id'];

    $update = "UPDATE tbl_user SET nama_user='$name', email_user='$email', password_user='$pass', user_type='$user_type' where id_user='$id'";
         mysqli_query($conn, $update);
    if($update){
        header('location:dashboard_admin.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_admin.php');
    }
}

//hapus data user
if(isset($_POST['deleteuser'])){
    $id = $_POST['id'];

    $delete = "DELETE FROM tbl_user where id_user='$id'";
         mysqli_query($conn, $delete);
    if($delete){
        header('location:dashboard_admin.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_admin.php');
    }
}

//update data donasi
if(isset($_POST['updatedonasi'])){
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];
    $id = $_POST['id'];

    $update = "UPDATE tbl_donasi SET nama_donatur='$name', email_donatur='$email', notelp_donatur='$telp', jumlah='$jumlah' where id_donasi='$id'";
         mysqli_query($conn, $update);
    if($update){
        header('location:dashboard_datadonasi.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_datadonasi.php');
    }
}

//hapus data donasi
if(isset($_POST['deletedonasi'])){
    $id = $_POST['id'];

    $delete = "DELETE FROM tbl_donasi where id_donasi='$id'";
         mysqli_query($conn, $delete);
    if($delete){
        header('location:dashboard_datadonasi.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_datadonasi.php');
    }
}

//tambah data jadwal
if(isset($_POST['addnewjadwal'])){
    $tgl =  $_POST['tgl'];
    $ket = $_POST['ket'];
    $id = $_POST['id'];
    $koor = $_POST['koor'];
    $id_koor = $_POST['id_koor'];

    $insert = "INSERT INTO tbl_jadwal(tanggal, keterangan_jadwal, nama_koor, id_user) VALUES('$tgl','$ket','$koor','$id_koor')";
         mysqli_query($conn, $insert);
    if($insert){
        header('location:dashboard_datajadwal.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_datajadwal.php');
    }
}

//update data jadwal
if(isset($_POST['updatejadwal'])){
    $tgl =  $_POST['tgl'];
    $ket = $_POST['ket'];
    $id = $_POST['id'];
    $id_user = $_POST['id_user'];

    $nama_koor = mysqli_query($conn, "SELECT nama_user FROM tbl_user WHERE id_user = '$id_user'");
    $koor= mysqli_fetch_array($nama_koor)["nama_user"];

    $update = "UPDATE tbl_jadwal SET tanggal='$tgl', keterangan_jadwal='$ket', nama_koor='$koor' where id_jadwal='$id'";
         mysqli_query($conn, $update);
    if($update){
        header('location:dashboard_datajadwal.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_datajadwal.php');
    }
}

//hapus data jadwal
if(isset($_POST['deletejadwal'])){
    $id = $_POST['id'];

    $delete = "DELETE FROM tbl_jadwal where id_jadwal='$id'";
         mysqli_query($conn, $delete);
    if($delete){
        header('location:dashboard_datajadwal.php');
    } else {
        echo 'Gagal';
        header('location:dashboard_datajadwal.php');
    }
}
?>

