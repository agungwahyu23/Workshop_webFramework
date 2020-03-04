<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <form method="POST" action="<?= ($aksi == '2' ? base_url('artikel/update/'.$data['kode_artikel']) : base_url('artikel/storeadd')) ?>" enctype="multipart/form-data">
        <p>
            Judul
        </p>
        <input name="judul" type="text" value="<?= ($aksi == '2' ? $data['judul'] : '') ?>" required placeholder="Masukkan Judul" /><br />
        <p>
            Penulis
        </p>
        <input name="penulis" type="text" value="<?= ($aksi == '2' ? $data['penulis'] : '') ?>" required placeholder="Masukkan Penulis" /><br />
        <p>
            Deskripsi
        </p>
        <textarea name="deskripsi" required placeholder="Masukkan Deskripsi"><?= ($aksi == '2' ? $data['deskripsi'] : '') ?></textarea><br /><br />
        <input type="submit" value="Kirim Data  " />
    </form>
</body>

</html>