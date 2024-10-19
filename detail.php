<?php
include "service/database.php";

if (!isset($_SESSION['halo']) || $_SESSION['halo'] != "green") {
    header("Location: login.php");
    $login_message = "Login terlebih dahulu";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "Layout/script.html";
    include "Layout/link.html";
    ?>
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_GET['detail'])) {
        $id = $_GET['detail'];
        $query = "SELECT * FROM employee WHERE employee_id = '$id'";
        $sql = mysqli_query($db, $query);
    }
    ?>
    <a href="dashboard.php" type="submit" name="back" class="btn btn-primary mt-4 ms-4">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
        Back</a>

    <div class="mt-2 ms-4">
        <?php
        while (($result = mysqli_fetch_assoc($sql))) {
            ?>
            <h1>Detail Data <?php echo $result['nama'] ?> </h1><br />
            <img src="uploads/<?php echo $result['foto'] ?>" style="width: 150px;" alt="">
            <div class="mt5">
                <p>ID : <?php echo $result['employee_id'] ?></p>
                <p>Nama : <?php echo $result['nama'] ?></p>
                <p>Umur : <?php echo $result['umur'] ?></p>
                <p>Jenis Kelamin : <?php echo $result['jenis_kelamin'] ?></p>
                <p>Pendidikan Terakhir: <?php echo $result['pendidikan_terakhir'] ?></p>
                <p>Status : <?php echo $result['status'] ?></p>
                <p>Jabatan : <?php echo $result['jabatan'] ?></p>
                <p>Tanggal Rekrut : <?php echo $result['tanggal_rekrut'] ?></p>
                <p>Gaji : <?php echo $result['gaji'] ?></p>
            </div>
        <?php
        }
        ?>
    </div>

    

</body>

</html>