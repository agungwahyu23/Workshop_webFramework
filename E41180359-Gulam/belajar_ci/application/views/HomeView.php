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

<!-- <h1> Upload Gambar </h1>
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
</form> -->
<center>
<h1>CRUD dengan codeigniter </h1>
<h3> <a href="index.php/home/tambah"> + Tambah Artikel </a></h3>
<table border= "1" cellpadding="5">
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>isi</th>
        <th>Aksi</th>
    </tr>
    <?php
    foreach ($artikel as $row) {
        ?>
        <tr>
            <td><?php echo $row->judul; ?></td>
            <td><?php echo $row->penulis; ?></td>
            <td><?php echo substr($row->isi, 0, 70);
            ?>...</td>
            <td>
                <a href="<?php echo "index.php/home/detail/".$row->id; ?>">Detail</a>
                <a href="<?php echo "index.php/home/ubah/".$row->id; ?>">Ubah</a>
                <a href="<?php echo "index.php/home/hapus/".$row->id; ?>">Hapus</a>
            </td>
        </tr> 
        <?php
}
        ?>
</table> 
</center>