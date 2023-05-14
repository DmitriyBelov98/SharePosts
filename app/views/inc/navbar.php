

    <nav class="nav">
        <div class="container nav__container">
            <a href="<?= URLROOT ?>" class="nav__logo"><?= SITENAME ?></a>
<ul class="nav__items">
    <li><a href="<?= URLROOT ?>">Главная</a></li>
    <li><a href="<?= URLROOT ?>/pages/about">О проекте</a></li>

    <?php if(isset($_SESSION['user_id'])): ?>
        <li><a href="">Добро пожаловать: <?= $_SESSION['user_name'] ?></a></li>
        <li><a href="<?= URLROOT ?>/users/logout">Выйти</a></li>
    <?php else : ?>

    <li><a href="<?= URLROOT ?>/users/register">Регистрация</a></li>
    <li><a href="<?= URLROOT ?>/users/login">Вход</a></li>
    <?php endif; ?>
    <!--                <li><a href="signin.html">Signin</a></li>-->

</ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>

</div>

</nav>
