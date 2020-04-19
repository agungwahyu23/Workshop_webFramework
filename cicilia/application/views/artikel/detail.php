<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <b>
        Judul
    </b>
    <p>
        <?= $data['judul'] ?>
    </p>
    <b>
        Penulis
    </b>
    <p>
        <?= $data['penulis'] ?>
    </p>
    <b>
        Tanggal
    </b>
    <p>
        <?= $data['create_at'] ?>
    </p>
    <b>
        Isi
    </b>
    <p>
        <?= $data['deskripsi'] ?>
    </p>
</body>

</html>