<h1> Upload Gambar </h1>
<?php
echo $error;
if ($data) {
    ?>
    <h3>Gambar Berhasil di Upload</h3>
    <img src="../gambar/<?php echo $data ["file_name"]; ?>" alt="" width="200">
    <?php
}
?>

<form method="post" enctype="multipart/form-data">
<input type="file" name="gambar" id="gambar">
<button type="submit">Upload</button>
</form>

<!-- <h2> Masukkan Data Anda </h2>
<form method="post">
    <label for="nama">Nama</label> <br>
    <input type="text" name="nama" id="nama"> <br>
    <label for="email">Email</label> <br>
    <input type="email" name="email" id="email"> <br>
    <button type="submit">Kirim</button>
</form> -->