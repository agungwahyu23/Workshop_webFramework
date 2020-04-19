<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <?php
    if (isset($path)) {
        $link = base_url($path);
        echo "<img src='$link' width=200>";
    }
    if (isset($error)) {
        // echo "<ul>";
        //     foreach ($error as $item => $value):
        //         echo "<li>". $item .':'.$value .'</li>';
        //     endforeach;
        // echo "</ul>";
        echo $error;
    }
    ?>
    <form method="POST" action="<?= base_url('home/storeadd') ?>" enctype="multipart/form-data">
        <p>
            Pilih Gambar
        </p>
        <input name="foto" type="file" required /><br /><br />
        <input type="submit" value="Upload Foto" />
    </form>
</body>

</html>