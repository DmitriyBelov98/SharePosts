<?php require APPROOT . '/views/inc/header.php';



$title = $_SESSION['add-data']['title'] ?? null;
$body = $_SESSION['add-data']['body'] ?? null;
unset($_SESSION['add-data']);
?>
<section class="form">
    <div class="container form__container">

        <h2>Создать пост</h2>
        <?php
        if (isset($_SESSION['add'])) : ?>
            <div class="form__message form__message-error">
                <p>
                    <?= $_SESSION['add'];
                    unset($_SESSION['add'])
                    ?>

                </p>
            </div>
        <?php endif; ?>

        <form action="<?= URLROOT ?>/posts/add" method="post">

            <input type="text" placeholder="Title" value="<?= $title?>" name="title">
            <textarea rows="10" placeholder="Body" name="body"><?= $body?></textarea>
            <button type="submit" class="btn">Создать</button>

        </form>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>