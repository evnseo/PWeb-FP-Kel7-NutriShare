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
?>