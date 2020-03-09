<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" />
</head>

<body class="container">
    <form method="POST" class="col-md-6" action="<?= ($aksi == '2' ? base_url('artikel/update/' . $data['kode_artikel']) : base_url('artikel/storeadd')) ?>" enctype="multipart/form-data">
        <h1>Form Artikel</h1>
        <p>
            Judul
        </p>
        <input name="judul" class="form-control" type="text" value="<?= ($aksi == '2' ? $data['judul'] : '') ?>" required placeholder="Masukkan Judul" /><br />
        <p>
            Penulis
        </p>
        <input name="penulis" class="form-control" type="text" value="<?= ($aksi == '2' ? $data['penulis'] : '') ?>" required placeholder="Masukkan Penulis" /><br />
        <p>
            Deskripsi
        </p>
        <textarea name="deskripsi" class="form-control" required placeholder="Masukkan Deskripsi"><?= ($aksi == '2' ? $data['deskripsi'] : '') ?></textarea><br /><br />
        <input type="submit" class="btn btn-primary" value="Kirim Data  " />
    </form>
</body>

</html>