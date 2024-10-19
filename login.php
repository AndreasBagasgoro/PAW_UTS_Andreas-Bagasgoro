<?php
include "service/database.php";
session_start();
$login_message = "";

if (isset($_SESSION["is_login"])) {
    header("Location: dashboard.php");
}



if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $_data["username"];
        $_SESSION["is_login"] = true;
        $_SESSION['halo'] = "green";
        header("Location: dashboard.php");
    } else {
        $login_message = "Username tidak ditemukan";
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
    <div class="text-center mt-5">

        <?php include "Layout/header.html" ?>
        <h2 class="mt-3 mb-3">LOGIN</h2>
        <form action="login.php" method="POST">
            <div class="mb-3 form-check">
                <label for="username"></label>
                <input type="text" placeholder="username" name="username" id="username" required>
            </div>
            <div class="mb-3 form-check">
                <label for=""></label>
                <input type="password" placeholder="password" name="password" id="password" required>
            </div>
            <button class="btn btn-primary" type="submit" name="login">Login</button>
        </form>
        <i><?= $login_message ?></i>

        <?php include "Layout/footer.html" ?>
    </div>
</body>

</html>