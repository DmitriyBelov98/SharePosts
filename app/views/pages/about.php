<?php require APPROOT . '/views/inc/header.php';
?>
    <h1 class="title title-center"><?= $data['title']; ?></h1>
    <h2 class="description"><?= $data['description'] ?></h2>
    <p>Версия: <strong><?= APPVERSION ?></strong></p>
<?php require APPROOT . '/views/inc/footer.php';
?>