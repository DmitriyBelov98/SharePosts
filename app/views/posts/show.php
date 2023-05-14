<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $data['post']->title ?></h2>
        <div class="post__author">
            <div class="post__author-avatar">
                <i class="uil uil-user"></i>
            </div>
            <div class="posts__author-info">
                <h5><?= $data['user']->name ?></h5>
                <small><?= $data['post']->created_at ?></small>
            </div>
        </div>

        <p><?= $data['post']->body ?> </p>

        <?php if ($data['post']->user_id == $_SESSION['user_id']) :?>

            <div class="show__wrapper">
                <a href="<?= URLROOT ?>/posts/edit/<?= $data['post']->id?>" class="btn btn_small">Редактировать</a>
                <form action="<?=  URLROOT?>/posts/delete/<?= $data['post']->id?>" method="post">
                    <button type="submit" class="btn btn_small danger">Удалить</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

</section>

<?php require APPROOT . '/views/inc/footer.php';