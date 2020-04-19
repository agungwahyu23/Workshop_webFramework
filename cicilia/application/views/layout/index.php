<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('assets/css/bootstrap.css') ?>" rel="stylesheet"/>
    <link href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet"/>
    <title><?= $title ?></title>
</head>

<body class="container">
        <?php
        include str_replace("system", "application/views/", BASEPATH) . "/layout/header.php";
        echo '<div class="main-panel"><div class="content">';
        include str_replace("system", "application/views/", BASEPATH) . "/layout/content.php";
        echo '</div></div>';
        ?>

    </div>
    </div>

</body>

</html>