<?php

class Pages extends Controller
{

    public function __construct(

    )
    {

    }

    public function index()
    {
        if (isLoggedIn()) {
            redirect('posts');
        }
        $data = [
            'title' => 'Shareposts',
            'description' => 'Простое CRUD web-приложение построенное на MVC фреймворке'
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About',
            'description' => 'Страница с информацией о проекте'
        ];
        $this->view('pages/about', $data);
    }

}
