<?php

/*
 * Основной контроллер
 * загружает моделии представления
 *
 * */

class Controller
{
    // model

    public function model($model)
    {
        // require model file

        require_once "../app/models/" . $model . ".php";

        // объявление модели
        return new $model();
    }

    // load view

    public function view($view, $data = [])
    {
        // Check for view file

        if (file_exists('../app/views/' . $view . ".php")) {
            require_once '../app/views/' . $view . ".php";
        } else {
            // view не существует
            die('View does not exist');
        }
    }




}