<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg user
if (!isset($_SESSION["user"])) {
    header("location:login.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h1>
        <div>
            <img width="40%" src="hazama.jpg.webp" style="display:block; margin:auto;">
        </div>
    </h1>
    
</body>
</html>

