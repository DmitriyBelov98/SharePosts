<?php


// App core class - создаёт пути и загружает главные контроллеры
// Формат URL - /controller/method/params
namespace libraries;
class Core
{
    public function __construct(
        protected  $currentController = 'Pages',
        protected  $currentMethod = 'index',
        protected  $params = []

    )
    {
//        print_r($this->getUrl());
        $url = $this->getUrl();
        // Look in controllers for first value

        if ($url !== null && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // если существует то устанавливаем как текущий контролер
            $this->currentController = ucwords($url[0]);
            // unset 0 index
            unset($url[0]);
        }
        // получить контроллер
        require_once "../app/controllers/" . $this->currentController . '.php';

        // объявить экземпляр контроллера
        $this->currentController = new $this->currentController;

        // проверка второй части url запроса

        if (isset($url[1])) {
            // проверка на существование метода и контролера
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // get params

        $this->params = $url ? array_values($url) : [];

        // вызов колбэка с массивом параметров

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }
    public function getUrl()
    {

        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }


    }
}
