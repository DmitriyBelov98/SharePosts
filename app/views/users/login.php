<?php require APPROOT . '/views/inc/header.php';


$email = $_SESSION['login-data']['email'] ?? null;
$password = $_SESSION['login-data']['password'] ?? null;
unset($_SESSION['login-data']);
?>
<section class="form">
    <div class="container form__container">
     <div class="auth__container">

            <h3>Тестовые данные</h3>
            <div>
                <p>Логин: bonegrowler@gmail.com</p>
                <p>Пароль: 123456</p>
            </div>
        </div>

            <?php flash('succes'); ?>


        <h2>Вход</h2>

        <?php
        if (isset($_SESSION['login'])) : ?>
        <div class="form__message form__message-error">
            <p>
                <?= $_SESSION['login'];
                unset($_SESSION['login'])
                ?>

            </p>
        </div>
        <?php endif; ?>
        <form action="<?= URLROOT ?>/users/login" method="POST">

            <input type="email" name="email" value="<?= $email ?>" placeholder="Email" >
            <input type="password" name="password" value="<?= $password ?>" placeholder="Create Password" >

            <button type="submit" class="btn">Войти</button>
            <small>Нет аккаунта ? <a href="<?= URLROOT ?>/users/register">Зарегистрироваться</a></small>
        </form>
    </div>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>
