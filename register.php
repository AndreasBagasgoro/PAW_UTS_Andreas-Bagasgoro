<?php
include "service/database.php";
session_start();
$register_message = "";
$error = [];

if (isset($_SESSION["is_login"])) {
    header("Location: dashboard.php");
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);
    if (empty($username) || empty($password)) {
        if (empty($username)) {
            $register_message = "Username kosong, silahkan isi";
        } else if (empty($password)) {
            $register_message = "Pasword kosong, silahkan isi";
        }
    } else {
        try {
            $sql = "INSERT INTO users (username, password) 
            VALUES('$username', '$hash_password')";

            if ($db->query($sql)) {
                $register_message = "Registrasi berhasil, silahkan login";
            } else {
                $register_message = "Registrasi tidak berhasil";
            }
        } catch (mysqli_sql_exception) {
            $register_message = "Username sudah digunakan";
        }
        $db->close();
    }


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
    <?php include "Layout/header.html" ?>
    <h2>DAFTAR AKUN</h2>
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username">
        <input type="password" placeholder="password" name="password">
        <button type="submit" name="register">Register</button>
    </form>
    <i><?= $register_message ?></i>
    <?php include "Layout/footer.html" ?>
</body>

</html>