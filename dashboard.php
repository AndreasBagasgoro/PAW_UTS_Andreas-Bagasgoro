<?php
session_start();
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
}
if (!isset($_SESSION['halo']) || $_SESSION['halo'] != "green") {
    header("Location: login.php");
    $login_message = "Login terlebih dahulu";
    exit();
}

include 'service/database.php';


$query = "SELECT * FROM employee;";
$sql = mysqli_query($db, $query);

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
    <?php include "Layout/navbar.html" ?>
    <main class="container">

        <h1 class="mt-4">Selamat datang <?= $_SESSION["username"] ?></h1>
        <form action="">
            <a href="manage.php" type="submit" name="insert" class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Insert</a>
        </form>

        <div class="table-responsive">
            <table class="table allign-middle mt-3 table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID Karayawan</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Jabatan</th>
                        <th>Foto</th>
                        <th>Gaji</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    while ($result = mysqli_fetch_assoc($sql)) {
                        ?>
                        <tr>
                            <td> <?php echo $result['employee_id'] ?></td>
                            <td><?php echo $result['nama'] ?></td>
                            <td><?php echo $result['umur'] ?></td>
                            <td><?php echo $result['jabatan'] ?></td>
                            <td>
                                <img src="uploads/<?php echo $result['foto'] ?>" style="width: 150px;" alt="">
                            </td>
                            <td><?php echo $result['gaji'] ?></td>


                            <td>
                                <a href="detail.php?detail=<?php echo $result['employee_id'] ?>">Detail</a>
                            </td>
                            <td>
                                <a href="manage.php?edit=<?php echo $result['employee_id'] ?>" type="button"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="process.php?delete=<?php echo $result['employee_id'] ?>" type="button"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <form class="pt-2" action="dashboard.php" method="POST">
            <button href="" type="submit" name="logout" class="btn btn-danger">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Logout</button>
        </form>

    </main>
    <?php include "Layout/footer.html" ?>
</body>

</html>