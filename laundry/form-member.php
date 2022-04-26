<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg petugas
if (!isset($_SESSION["user"])) {
    header("location:Login.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Member</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-turquoise">
    <div class="container-fluid mt-5">
        <div class="card bg-turquoise">
        <div class="card-header mt-3">
                <h5 class="text-dark">Form Member</h5>
            </div>

            <div class="card-body bg-turquoise text-dark">
                <?php
                if (isset($_GET["id_member"])) {
                    // memeriksa ketika load file ini
                    // apakah membawa data GET dg nama "id_member"
                    // jika true, maka form pelanggan digunakan utk edit

                    # mengakses data pelanggan dari id_member yg dikirim
                    include "connection.php";
                    $id_member = $_GET["id_member"];
                    $sql = "select * from member where id_member='$id_member'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $member = mysqli_fetch_array($hasil);
                    ?>

                <form action="process-member.php" method="post">
                    ID Member
                    <input type="text" name="id_member"
                    class="form-control mb-2 btn-outline-info bg-light text-dark" required
                    value="<?=$member["id_member"] ?>" readonly>

                    Nama 
                    <input type="text" name="nama"
                    class="form-control mb-2 btn-outline-info bg-light text-dark" required
                    value="<?=$member["nama"] ?>">

                    Alamat 
                    <input type="text" name="alamat"
                    class="form-control mb-2 btn-outline-info bg-light text-dark" required
                    value="<?=$member["alamat"] ?>">

                    Jenis Kelamin
                    <input type="text" name="jenis_kelamin"
                    class="form-control mb-2 btn-outline-info bg-light text-dark" required
                    value="<?=$member["jenis_kelamin"] ?>">
                    
                    No. Telepon
                    <input type="text" name="tlp"
                    class="form-control mb-2 btn-outline-info bg-light text-dark" required
                    value="<?=$member["tlp"] ?>">

                    <button type="submit" class="btn btn-primary btn-block"
                    name="edit_member" onclick="return confirm('Apakah anda yakin?')">
                        Save
                    </button>
                </form>

                    <?php
                }else {
                    // jika false, maka form pelanggan digunakan utk insert
                    ?>

                <form action="process-member.php" method="post">
                    ID Member
                    <input type="text" name="id_member"
                    class="form-control mb-2 btn-outline-info bg-turquoise" required>
                    
                    Nama
                    <input type="text" name="nama"
                    class="form-control mb-2 btn-outline-info bg-turquoise" required>

                    Alamat
                    <input type="text" name="alamat"
                    class="form-control mb-2 btn-outline-info bg-turquoise" required>

                    Jenis Kelamin
                    <select name="jenis_kelamin" class="form-control mb-2 btn-outline-info bg-turquoise text-dark" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    No.Telepon
                    <input type="text" name="tlp"
                    class="form-control mb-2 btn-outline-info bg-turquoise" required>


                    <button type="submit" class="btn btn-info btn-block mt-3"
                    name="simpan_member" onclick="return confirm('Apakah anda yakin?')">
                        Save
                    </button>
                </form>

                    <?php
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>