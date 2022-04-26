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
    <title>Daftar Member</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container-fluid mt-5">
        <div class="card bg-dark">
        <div class="card-header bg-dark mt-2 btn">
                <h4 class="text-dark">Data Member</h4>
            </div>
            <div class="card-body bg-dark">
                <!-- tombol daftar -->
                <a href="form-member.php">
                <button class="btn btn-outline-info btn-block">
                        Daftar Menjadi Member
                    </button>
                </a>
                <hr>
                <!-- kotak pencarian data pelanggan -->
                <form action="list-member.php" method="get">
                    <input type="text" name="search"
                    class="form-control btn-outline-info bg-dark mb-3 text-dark"
                    placeholder="Masukan Keyword Pencarian"
                    required>
                </form>
                <ul class="list-group">
                    <?php
                    include("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pd saat load halaman ini
                        # akan mengecek apakah ada data dgn method
                        # GET yg bernama search
                        $search = $_GET["search"];
                        $sql = "select * from member
                        where id_member like '%$search%'
                        or nama like '%$search%'
                        or alamat like '%$search%'
                        or jenis_kelamin like '%$search%'
                        or tlp like '%$search%'";
                    } else {
                        $sql = "select * from member";
                    }
                    //eksekusi perintah sql
                    $query = mysqli_query($connect, $sql);
                    while($member = mysqli_fetch_array($query)){ ?>
                        <li class="list-group-item btn-outline-info bg-dark">
                        <div class="row">
                            <!-- bagian data pelanggan-->
                            <div class="col-lg-10 col-md-10 ">
                            <h5>ID : <?php echo $member["id_member"];?></h5>
                                <h6>Nama : <?php echo $member["nama"];?></h6>
                                <h6>Alamat : <?php echo $member["alamat"];?></h6>
                                <h6>jenis_kelamin : <?php echo $member["jenis_kelamin"];?></h6>
                                <h6>No Telepon : <?php echo $member["tlp"];?></h6>
                            </div>

                            <!-- bagian tombol pilihan-->
                            <div class="col-lg-2 col-md-2">
                                <a href="form-member.php?id_member=<?=$member["id_member"]?>">
                                    <button class="btn btn-block btn-info mb-2">
                                        Edit
                                    </button>
                                </a>
                                <a href="process-member.php?id_member=<?=$member["id_member"]?>">
                                    <button class="btn btn-block btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')">
                                        Remove
                                    </button>
                                </a>
                            </div>
                        </div>
                        </li>
                    <?php
                    }
                    ?>
                    
                </ul>
            </div>
        </div>
    </div>
</body>
</html>