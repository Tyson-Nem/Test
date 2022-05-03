<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Treloosh | <?= $title ?></title>

    <?php if (isConnected()) : ?>
    <link href="assets/css/header.css" rel="stylesheet" />
    <?php endif; ?>

    <link href="<?= $css ?>" rel="stylesheet" />
    <link rel="icon" type="image/png" href="assets/images/logo.png" />
</head>

<body>
    <?php if (isConnected()) :
        require_once 'view/header.php';
    endif; ?>
    <?= $content ?>
</body>

</html>