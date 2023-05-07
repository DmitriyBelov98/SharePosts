<?php

class Posts extends Controller
{

    public function __construct(

    )
    {
        // если мы не залогинились
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        // получить посты
        $posts = $this->postModel->getPosts();

        $data = [

            'posts' => $posts,


        ];
        $this->view('posts/index', $data);
    }

    public function add()
    {
        if (is_post_request()) {
            $data = [
                'title' => filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'body' => filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'user_id' =>$_SESSION['user_id'],
            ];

            if (!$data['title']) {
                $_SESSION['add'] = 'Заполните заголовок';
            } elseif (!$data['body']) {
                $_SESSION['add'] = 'Заполните информацию';
            }

            // если есть проблемы то возвращаемся на страницу добавления поста
            if (isset($_SESSION['add'])) {
                $_SESSION['add-data'] = $_POST;
                $this->view('posts/add', $data);
                die();

            } else {

                if ($this->postModel->addPost($data)) {
                    flash('post_success', 'Пост успешно создан', FLASH_SUCCESS);
                    redirect('posts');
                } else {
                    die('Что то пошло не так');
                }

            }
        } else {

            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->view('posts/add', $data);
        }


    }

    public function edit($id)
    {
        if (is_post_request()) {
            $data = [
                'id' => $id,
                'title' => filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'body' => filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'user_id' =>$_SESSION['user_id'],


            ];

            if (!$data['title']) {
                $_SESSION['edit'] = 'Заполните заголовок';
            } elseif (!$data['body']) {
                $_SESSION['edit'] = 'Заполните информацию';
            }

            // если есть проблемы то возвращаемся на страницу добавления поста
            if (isset($_SESSION['edit'])) {
                $_SESSION['edit-data'] = $_POST;
                $this->view('posts/edit', $data);
                die();

            } else {

                if ($this->postModel->updatePost($data)) {
                    flash('post_edit', 'Пост успешно отредактирован', FLASH_SUCCESS);
                    redirect('posts');
                } else {
                    die('Что то пошло не так');
                }

            }
        } else {
            // получить существующий пост
            $post = $this->postModel->getPostById($id);
            // проверка владельца поста
            if ($post->user_id !== $_SESSION['user_id']) {
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];
            $this->view('posts/edit', $data);
        }


    }

    public function show($id)
    {

        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];
        $this->view('posts/show', $data);
    }

    public function delete($id)
    {
        if (is_post_request()) {

            $post = $this->postModel->getPostById($id);
            // проверка владельца поста
            if ($post->user_id !== $_SESSION['user_id']) {
                redirect('posts');
            }
            if ($this->postModel->deletePost($id)) {
                flash('post_delete', 'Пост успешно удалён', FLASH_SUCCESS);
                redirect('posts');
            } else {
                die('Что то пошло не так');
            }
        } else {
            redirect('posts');
        }
    }

}