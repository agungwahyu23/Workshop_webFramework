
    <h1>
        Data Artikel
    </h1>
    <div>
        <a class="btn btn-primary" href="<?= base_url('artikel/add') ?>">Tambah</a>
    </div><br />
    <?php
    if (isset($_SESSION['pesan'])) {
        echo "<div class='alert alert-success'><b>" . $_SESSION['pesan'][0] . "</b>";
        echo "<p>" . $_SESSION['pesan'][1] . "</p></div>";
    }
    ?>
    <table border="1" class="table table-bordered">
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