<?php


use libraries\Controller;

class Users extends Controller
{
    public function __construct(

    )
    {
        $this->userModel = $this->model('User');
    }
    public function register()
    {
        // проверка на POST запрос
        if (is_post_request()) {

            // обработка данных

            // получение данных
            $data = [
                'name' => filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
                'password' => filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'confirm_password' => filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];
            // валидация  email
            if (!$data['name']) {
                $_SESSION['register'] = 'Пожалуйста введите username';

            } elseif (!$data['email']) {
                $_SESSION['register'] = 'Пожалуйста введите email';

            } elseif ($this->userModel->findUserByEmail($data['email'])) {

                    $_SESSION['register'] = 'Этот email уже существует';

            } elseif (!$data['password']) {
                $_SESSION['register'] = 'Пожалуйста введите пароль';
            } elseif (mb_strlen($data['password']) < 6) {
                $_SESSION['register'] = 'Пароль должен содержать минимум 6 символов';
            } elseif (!$data['confirm_password']) {
                $_SESSION['register'] = 'Пожалуйсте подтвердите пароль';
            } else {
                if ($data['password'] !== $data['confirm_password']) {
                    $_SESSION['register'] = 'Пароли не совпадают';
                }
            }

             // убедиться что ошибки пусты
            if (isset($_SESSION['register'])) {


                $_SESSION['register-data'] = $_POST;
                $this->view('users/register', $data);


            } else {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    flash('succes', 'Успешная регистрация', FLASH_SUCCESS);
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }

            }

        } else {
            // инициализация данных
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',

            ];

            // загрузить представление (view)
            $this->view('users/register', $data);

        }

    }

     public function login()
    {
        // проверка на POST запрос
        if (is_post_request()) {

            $data = [
                'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
                'password' => filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];


            if ($this->userModel->findUserByEmail($data['email'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // создаь сессию
                    $this->createUserSession($loggedInUser);
                } else {
                    $_SESSION['login'] = 'Проверте правильность введнных данных';

                }
                if (empty($data['email'])) {
                    echo $_SESSION['login'] = 'Пожалуйста введите email';

                }
                elseif (empty($data['password'])) {
                    $_SESSION['login'] = 'Пожалуйста введите пароль';
                }
            } else {
                $_SESSION['login'] = 'Данного пользователя не существует';
            }





            // если есть проблемы то возвращаемся на страницу логина
            if (isset($_SESSION['login'])) {
                $_SESSION['login-data'] = $_POST;
                $this->view('users/login', $data);

            }

            // получение данных
        } else {
            // инициализация данных
            $data = [
                'email' => '',
                'password' => '',
            ];

            // загрузить представление (view)
            $this->view('users/login', $data);


        }
//        $this->view('users/login', $data);
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }



}