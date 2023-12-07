<!DOCTYPE html>
<html>
<head>
    <title>Form Penumpang</title>
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
    if (isset($_GET['id_penumpang'])) {
        $id_penumpang=input($_GET["id_penumpang"]);

        $sql="select * from tiket where id_penumpang=$id_penumpang";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_penumpang=htmlspecialchars($_POST["id_penumpang"]);
        $nama=input($_POST["nama"]);
        $tujuan=input($_POST["tujuan"]);
        $class=input($_POST["class"]);
        $terminal=input($_POST["terminal"]);
        $no_hp=input($_POST["no_hp"]);

        //Query update data pada penumpang
        $sql="update tiket set
			nama='$nama',
			tujuan='$tujuan',
			class='$class',
			terminal='$terminal',
			no_hp='$no_hp'
			where id_penumpang=$id_penumpang";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Tujuan:</label>
            <input type="text" name="tujuan" class="form-control" placeholder="Masukan Tujuan" required/>
        </div>
        <div class="form-group">
            <label>Class :</label>
            <input type="text" name="class" class="form-control" placeholder="Masukan class" required/>
        </div>
        <div class="form-group">
            <label>Terminal:</label>
            <input type="text" name="terminal" class="form-control" placeholder="Masukan Terminal" required/>
        </div>
        <div class="form-group">
            <label>No Hp:</label>
            <textarea name="no_hp" class="form-control" rows="5"placeholder="Masukan No HP" required></textarea>
        </div>

        <input type="hidden" name="id_penumpang" value="<?php echo $data['id_penumpang']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>