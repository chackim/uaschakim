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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_peserta
    if (isset($_GET['idSaran'])) {
        $idSaran=input($_GET["idSaran"]);

        $sql="select * from tbtamu where idSaran=$idSaran";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);

    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $idSaran=htmlspecialchars($_POST["idSaran"]);
        $namaSaran=input($_POST["namaSaran"]);
        $emailSaran=input($_POST["emailSaran"]);
        $saran=input($_POST["saran"]);

        //Query update data pada tabel anggota
        $sql="update tbtamu set
			namaSaran='$namaSaran',
			emailSaran='$emailSaran',
			saran='$saran'
			where id_peserta=$idSaran";

        //Mengeksekusi atau menjalankan query diatas
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
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama :</label>
            <input type="text" name="namaSaran" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>email saran:</label>
            <input type="text" name="emailSaran" class="form-control" placeholder="Masukan email" required/>
        </div>
        <div class="form-group">
            <label>SARAN:</label>
            <textarea name="saran" class="form-control" rows="5"placeholder="Masukan SARAN" required></textarea>
        </div>

        <input type="hidden" name="idSaran" value="<?php echo $data['idSaran']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>