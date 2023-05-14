<?php

require APPROOT . '/views/inc/header.php';

// возврат данных формы если была ошибка регистрации


$username = $_SESSION['register-data']['username'] ?? null;
$email = $_SESSION['register-data']['email'] ?? null;
$password = $_SESSION['register-data']['password'] ?? null;
$confirm_password = $_SESSION['register-data']['confirm_password'] ?? null;


unset($_SESSION['register-data']);
?>

<section class="form">
    <div class="container form__container">

        <h2>Регистрация</h2>
        <?php
        if (isset($_SESSION['register'])) : ?>
        <div class="form__message form__message-error">
            <p>
                <?= $_SESSION['register'];
                unset($_SESSION['register'])
                ?>

            </p>
        </div>

        <?php endif; ?>

        <form action="<?= URLROOT ?>/users/register" method="POST" >
            <input type="text" name="username" value="<?= $username ?>" placeholder="Username" >
            <input type="email" name="email"  value="<?= $email ?>" placeholder="Email" >
            <input type="password" name="password" value="<?= $password ?>" placeholder="Create Password" >
            <input type="password" name="confirm_password" value="<?= $confirm_password ?>" placeholder="Confirm Password" >
<!--            <div class="form__control">-->
<!--                <label for="avatar">User avatar</label>-->
<!--                <input type="file" id="avatar">-->
<!--            </div>-->
            <button type="submit" class="btn">Зарегистрироваться</button>
            <small>Уже есть аккаунт ? <a href="<?= URLROOT ?>/users/login">Войти</a></small>
        </form>
    </div>


</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>

