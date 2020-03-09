
    <h1>
        Data Pekerja
    </h1>
    <div>
        <a class="btn btn-primary" href="<?= base_url('kerja/add') ?>">Tambah</a>
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
            <td>Nama</td>
            <td>No HP</td>
            <td>Lowker</td>
            <td>Tanggal</td>
            <td>Aksi</td>
        </tr>
        <?php
        $no = 1;
        foreach ($data as $p) { ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $p['nama'] ?></td>
                <td><?= $p['no_hp'] ?></td>
                <td><?= $p['lowker'] ?></td>
                <td><?= $p['create_at'] ?></td>
                <td>
                    <a href="<?= base_url('kerja/detail/' . $p['kode_kerja']) ?>">Detail</a>
                    &nbsp;
                    <a href="<?= base_url('kerja/edit/' . $p['kode_kerja']) ?>">Edit</a>
                    &nbsp;
                    <a href="<?= base_url('kerja/delete/' . $p['kode_kerja']) ?>" onclick="return confirm('apakah anda yakin ingin menghapus data?')">Hapus</a>
                </td>
            </tr>

        <?php
            $no++;
        }
        ?>
    </table>
</body>

</html>