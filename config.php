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

//insert data donasi
if(isset($_POST['addnewdonasi'])){
    echo "<pre>";     //console log
    print_r($_POST);
    echo "</pre>";

    $name =  $_POST['name'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $tgl = $_POST['tgl'];
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];

    // Debugging output
    echo "<pre>";
    echo "Nama: " . $name . "\n";
    echo "Email: " . $email . "\n";
    echo "Telp: " . $telp . "\n";
    echo "Tanggal: " . $tgl . "\n";
    echo "Jumlah: " . $jumlah . "\n";
    echo "Metode: " . $metode . "\n";
    echo "</pre>";

    $insert = "INSERT INTO tbl_donasi(nama_donatur, email_donatur, notelp_donatur, tanggal_donasi, jumlah, metode_bayar) VALUES('$name','$email','$telp','$tgl','$jumlah','$metode')";
    if (mysqli_query($conn, $insert)) {
        echo 'Berhasil menyimpan data donasi';
        header('Location: dashboard_user.php');
        exit();
    } else {
        echo 'Gagal menyimpan data';
        header('Location: dashboard_user.php');
        exit();
    }
}


//update data donasi
if(isset($_POST['updatedonasi'])){
    $name =  $_POST['name'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $tgl = $_POST['tgl'];
    $jumlah = $_POST['jumlah'];
    $metode = $_POST['metode'];
    $id = $_POST['id'];

    $update = "UPDATE tbl_donasi SET nama_donatur='$name', email_donatur='$email', notelp_donatur='$telp', tanggal_donasi='$tgl', jumlah='$jumlah', metode_bayar='$metode' where id_donasi='$id'";
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
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $tgl = $_POST['tgl'];
    $ket = $_POST['ket'];
    $koor = $_POST['koor']; // ini adalah id_user

    // Ambil nama_user berdasarkan id_user yang dipilih
    $query = "SELECT nama_user FROM tbl_user WHERE id_user='$koor'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $nama_koor = $data['nama_user'];

    // Insert data ke tabel tbl_jadwal
    $insert = "INSERT INTO tbl_jadwal (tanggal, keterangan_jadwal, nama_koor, id_user) VALUES ('$tgl', '$ket', '$nama_koor', '$koor')";
    if (mysqli_query($conn, $insert)) {
        header('Location: dashboard_datajadwal.php');
        exit();
    } else {
        echo 'Gagal menyimpan data';
        header('Location: dashboard_datajadwal.php');
        exit();
    }
}

//update data jadwal
if(isset($_POST['updatejadwal'])){
    $id = $_POST['id'];
    $tgl = $_POST['tgl'];
    $ket = $_POST['ket'];
    $koor = $_POST['koor'];

    // Debugging output
    //echo "<pre>";
    //echo "ID: " . $id . "\n";
    //echo "Tanggal: " . $tgl . "\n";
    //echo "Keterangan: " . $ket . "\n";
    //echo "Koordinator ID: " . $koor . "\n";
    //echo "</pre>";

    // Ambil nama_user berdasarkan id_user yang dipilih
    $query = "SELECT nama_user FROM tbl_user WHERE id_user='$koor'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    // Debugging output for $data
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    $nama_koor = $data['nama_user'];

    // Insert atau update data ke tabel tbl_jadwal
    $update = "UPDATE tbl_jadwal SET tanggal='$tgl', keterangan_jadwal='$ket', nama_koor='$nama_koor', id_user='$koor' WHERE id_jadwal='$id'";
    if (mysqli_query($conn, $update)) {
        header('Location: dashboard_datajadwal.php');
        exit();
    } else {
        echo 'Gagal menyimpan data';
        header('Location: dashboard_datajadwal.php');
        exit();
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

