<?php require APPROOT . '/views/inc/header.php';



?>
    <section class="form">
        <div class="container form__container">

            <h2>Редактировать пост</h2>
            <?php
            if (isset($_SESSION['edit'])) : ?>
                <div class="form__message form__message-error">
                    <p>
                        <?= $_SESSION['edit'];
                        unset($_SESSION['edit'])
                        ?>

                    </p>
                </div>
            <?php endif; ?>

            <form action="<?= URLROOT ?>/posts/edit/<?= $data['id'] ?>" method="post">

                <input type="text" placeholder="Title" value="<?= $data['title']?>" name="title">
                <textarea rows="10" placeholder="Body" name="body"><?= $data['body']?></textarea>
                <button type="submit" class="btn">Редактировать</button>

            </form>
        </div>
    </section>

<?php require APPROOT . '/views/inc/footer.php'; ?>