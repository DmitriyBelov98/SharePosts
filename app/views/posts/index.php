<?php require APPROOT . '/views/inc/header.php';
?>
   <div class="container">
       <div class="div">
           <h1>Посты</h1>
           <?php flash('post_success'); ?>
           <?php flash('post_edit'); ?>
           <?php flash('post_delete'); ?>
           <a href="<?= URLROOT ?>/posts/add" class="add__post">
               <i class="uil uil-pen"></i>
               <h5>Добавить пост</h5>
           </a>
       </div>
   </div>

    <div class="container posts__container">
<?php foreach ($data['posts'] as $post) : ?>



        <div class="posts__info">

            <h3 class="posts__title"><a href="<?= URLROOT ?>/posts/show/<?= $post->postId ?>"><?= $post->title ?></a></h3>





            <p class="posts__body"><?= $post->body ?></p>
            <div class="post__author">
                <div class="post__author-avatar">
                    <i class="uil uil-user"></i>
                </div>

                <div class="posts__author-info">
                    <h5><?= $post->name ?></h5>
                    <small><?= $post->postCreated ?></small>
                </div>
            </div>

            </div>

<?php endforeach; ?>
    </div>
<?php require APPROOT . '/views/inc/footer.php';
