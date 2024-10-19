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
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            display: none;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <?php include "Layout/navbar.html" ?>
    <main class="container mt-4">
        <h3>Silahkan masukkan data anda :</h3>



        <form action="process.php" method="POST" enctype="multipart/form-data">

            <?php if (isset($_GET['edit'])) {
                $id = $_GET['edit'];
                $query = "SELECT * FROM employee WHERE employee_id = '$id';";
                $sql = mysqli_query($db, $query);
                while (($result = mysqli_fetch_assoc($sql))) {
                    ?>
                    <div class="mb-3 row">
                        <label for="id" class="col-sm-2 col-form-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-50" name="id" id="id"
                                value="<?php echo $result['employee_id'] ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-50" id="nama" name="nama"
                                value="<?php echo $result['nama'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control w-50" id="umur" name="umur"
                                value="<?php echo $result['umur'] ?>" required>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control w-50" id="jenisKelamin" name="jenisKelamin" required>
                                <option name="laki-laki" value="Laki-laki" <?php if ($result['jenis_kelamin'] == 'Laki-laki') {
                                    echo "selected";
                                } ?>>Laki-laki</option>
                                <option name="perempuan" value="Perempuan" <?php if ($result['jenis_kelamin'] == 'Perempuan') {
                                    echo "selected";
                                } ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan terakhir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-50" id="pendidikan" name="pendidikan"
                                value="<?php echo $result['pendidikan_terakhir'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control w-50" id="status" name="status" required>
                                <option <?php if($result['status']=='menikah'){echo "selected";}?>name="menikah" value="menikah">Menikah</option>
                                <option <?php if($result['status']=='belum menikah'){echo "selected";}?>name="belum-menikah" value="belum-menikah">Belum menikah</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-50" id="jabatan" name="jabatan"
                                value="<?php echo $result['jabatan'] ?>" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" name="foto" id="foto" value="<?php echo $result['foto'] ?>" <?php if (!isset($_GET['edit'])) {
                                   echo "required";
                               } ?> />
                            <br>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggalRekrut" class="col-sm-2 col-form-label">Tanggal Rekrut</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control w-50" id="tanggalRekrut" name="tanggalRekrut"
                                value="<?php echo $result['tanggal_rekrut'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gaji" class="col-sm-2 col-form-label">Gaji</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control w-50" id="gaji" name="gaji"
                                value="<?php echo $result['gaji'] ?>" required>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="mb-3 row">
                    <label for="id" class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50" name="id" id="id" placeholder="Ex: 0000" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50" id="nama" name="nama" placeholder="Ex: Nama" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control w-50" id="umur" name="umur" placeholder="Ex: 00" required>
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control w-50" id="jenisKelamin" name="jenisKelamin" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option name="laki-laki" value="Laki-laki">Laki-laki</option>
                            <option name="perempuan" value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan terakhir</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50" id="pendidikan" name="pendidikan"
                            placeholder="Ex: SMA/S1/S2/S3" required>
                    </div>
                </div>

                <div class="form-group mb-3 row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control w-50" id="status" name="status" required>
                            <option value="">Pilih status</option>
                            <option name="menikah" value="menikah">Menikah</option>
                            <option name="belum-menikah" value="belum-menikah">Belum menikah</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-50" id="jabatan" name="jabatan" placeholder="Ex: Staff"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <input type="file" name="foto" id="foto" required /> <br>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tanggalRekrut" class="col-sm-2 col-form-label">Tanggal Rekrut</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control w-50" id="tanggalRekrut" name="tanggalRekrut"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="gaji" class="col-sm-2 col-form-label">Gaji</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control w-50" id="gaji" name="gaji" placeholder="Rp. " required>
                    </div>
                </div>
            <?php } ?>

            <div class="mb-3 row">
                <div class="col">
                    <a href="dashboard.php" type="submit" name="back" class="btn btn-primary mt-4">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        Back</a>

                    <?php if (isset($_GET['edit'])) {
                        ?>
                        <button type="submit" name="aksi" value="save" class="btn btn-success mt-4">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Save</button>
                        <?php
                    } else {
                        ?>
                        <button type="submit" name="aksi" value="insert" class="btn btn-success mt-4">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Insert</button>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </form>

    </main>
</body>

</html>