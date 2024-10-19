<?php
include "service/database.php";
$insert_massage = "";



if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'insert') {
        $employee_id = $_POST['id'];
        $nama = $_POST['nama'];
        $umur = $_POST['umur'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $pendidikan = $_POST['pendidikan'];
        $status = $_POST['status'];
        $jabatan = $_POST['jabatan'];
        $foto = $_FILES['foto']['name'];
        $tanggalRekrut = $_POST['tanggalRekrut'];
        $gaji = $_POST['gaji'];

        $target_path = "uploads/";
        $tmpFiles = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmpFiles, $target_path . $foto);

        $sql = "INSERT INTO employee (employee_id, nama, umur, jenis_kelamin, pendidikan_terakhir, status, foto, jabatan, tanggal_rekrut, gaji) 
        VALUES ('$employee_id', '$nama', '$umur', '$jenisKelamin', '$pendidikan','$status','$foto', '$jabatan', '$tanggalRekrut', '$gaji')";
        if ($db->query($sql)) {
            $insert_massage = "Data berasil ditambahkan";
        } else {
            $insert_massage = "Data tidak berhasil ditambahkan";
        }
        header("Location: dashboard.php");
        $db->close();
    } else if ($_POST['aksi'] == 'save') {
        $employee_id = $_POST['id'];
        $nama = $_POST['nama'];
        $umur = $_POST['umur'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $pendidikan = $_POST['pendidikan'];
        $status = $_POST['status'];
        $jabatan = $_POST['jabatan'];
        $tanggalRekrut = $_POST['tanggalRekrut'];
        $gaji = $_POST['gaji'];

        $query = "UPDATE employee SET nama='$nama', umur='$umur', jenis_kelamin='$jenisKelamin', pendidikan_terakhir = '$pendidikan', status ='$status', jabatan = '$jabatan', tanggal_rekrut='$tanggalRekrut', gaji = '$gaji' WHERE employee_id = '$employee_id';";
        $sql = mysqli_query($db, $query);

        header("Location: dashboard.php");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM employee WHERE employee_id = '$id';";
    $sql = mysqli_query($db, $query);

    var_dump($sql);
    if ($sql) {
        header("Location: dashboard.php");
    } else {
        echo $query;
    }
}

?>