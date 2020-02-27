<!-- <h1> Selamat Datang di Website JTI </h1>
<p> Berikut ini mahasiswa bermasalah : </p>

Nama : <?php echo $data ["nama"] ; ?><br>
Status : <?php echo $data ["status"] ; ?><br>
Website : <?php echo $data ["website"] ; ?><br> -->

<!-- <h2> Masukan Data Anda </h2>
<form method = "post">
    <label for="nama">Nama</label><br>
    <input type="text" name="nama" id="nama"><br>
    <label for="email">Email</label><br>
    <input type="email" name="email" id="email"><br>
    <button type="submit">kirim</button>
</form> -->

<h1> Upload Gambar </h1>
<?php
echo $error;
if($data) {
    ?>
    <h3>Gambar Berhasil diupload</h3>
    <img src="../gambar/<?php echo $data["file_name"];?>"
    width="200">
    <?php
}
?>
<form method="post" enctype="multipart/form-data">
<input type="file" name="gambar" id="gambar"/>
<button type="submit">upload</button>
</form>