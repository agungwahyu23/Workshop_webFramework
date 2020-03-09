<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" />
</head>

<body class="container">
    <form method="POST" class="col-md-6" action="<?= ($aksi == '2' ? base_url('kerja/update/' . $data['kode_kerja']) : base_url('kerja/storeadd')) ?>" enctype="multipart/form-data">
        <h1>Data Pekerja</h1>
        <p>
            Nama
        </p>
        <input name="nama" class="form-control" type="text" value="<?= ($aksi == '2' ? $data['nama'] : '') ?>" required placeholder="Masukkan nama" /><br />
        <p>
            No HP
        </p>
        <input name="no_hp" class="form-control" type="number" value="<?= ($aksi == '2' ? $data['no_hp'] : '') ?>" required placeholder="Masukkan No HP" /><br />
       <p>
           Lowker
        </p>
        <input name="lowker" class="form-control" type="text" value="<?= ($aksi == '2' ? $data['lowker'] : '') ?>" required placeholder="Masukkan Lowker" /><br />
       <input type="submit" class="btn btn-primary" value="Kirim Data  " />
    </form>
</body>

</html>