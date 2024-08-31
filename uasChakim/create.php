<!DOCTYPE html>
<html>
<head>
    <title>SARAN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $namaSaran=input($_POST["namaSaran"]);
        $emailSaran=input($_POST["emailSaran"]);
        $saran=input($_POST["saran"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into tbtamu (namaSaran,emailSaran,saran) values
		('$namaSaran','$emailSaran','$saran')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:daftar.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>NAMA :</label>
            <input type="text" name="namaSaran" class="form-control" placeholder="Masukan Nama" required/>
        </div>
       <div class="form-group">
            <label>EMAIL :</label>
            <input type="text" name="emailSaran" class="form-control" placeholder="Masukan email" required/>
        </div>
                </p>
        <div class="form-group">
            <label>SARAN  :</label>
            <textarea name="saran" class="form-control" rows="5"placeholder="Masukan saran" required></textarea>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>