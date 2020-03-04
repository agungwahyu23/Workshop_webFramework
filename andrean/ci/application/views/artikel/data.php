<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <h1>
        Data Artikel
    </h1>
    <div>
        <a href="<?= base_url('artikel/add') ?>">Tambah</a>
    </div><br />
    <?php
    if (isset($_SESSION['pesan'])) {
        echo "<b>" . $_SESSION['pesan'][0] . "</b>";
        echo "<p>" . $_SESSION['pesan'][1] . "</p>";
    }
    ?>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Judul</td>
            <td>Penulis</td>
            <td>Deskripsi</td>
            <td>Tanggal</td>
            <td>Aksi</td>
        </tr>
        <?php
        $no = 1;
        foreach ($data as $p) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $p['judul'] ?></td>
                <td><?= $p['penulis'] ?></td>
                <td><?= $p['deskripsi'] ?></td>
                <td><?= $p['create_at'] ?></td>
                <td>
                    <a href="<?= base_url('artikel/detail/' . $p['kode_artikel']) ?>">Detail</a>
                    &nbsp;
                    <a href="<?= base_url('artikel/edit/' . $p['kode_artikel']) ?>">Edit</a>
                    &nbsp;
                    <a href="<?= base_url('artikel/delete/' . $p['kode_artikel']) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data?')">Hapus</a>
                </td>
            </tr>

        <?php
            $no++;
        }
        ?>
    </table>
</body>

</html>