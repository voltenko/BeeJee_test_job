<?php

namespace app\lib\http;

/**
 * Класс запроса.
 * @package app\lib\http
 */
class Request
{
    private $data;
    private $method;
    private $uri;
    private $url;
    private $files = [];
    private $session;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'GET':
                $this->data = $_GET;
                break;
            case 'POST':
                $this->data = $_POST;
                break;
        }

        $this->method = $method;

        $uri = $_SERVER['REQUEST_URI'];
        $this->uri = $uri;
        $this->url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $this->addUploadFiles();
    }


    /**
     * Проверка метода.
     * @param string $method
     * @return bool
     */
    public function isMethod(string $method): bool
    {
        return strtolower($this->getMethod()) === strtolower($method);
    }


    /**
     * Получаем массив данных из запроса.
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * Получаем метод.
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }


    /**
     * Получаем путь.
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }


    /**
     * Получаем полный путь.
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


    /**
     * Получаем параметр запроса по имени.
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->data[$name] ?? false;
    }


    /**
     * Получаем загружаемый файл по имени инпута, или массив всех файлов.
     * @param string $inputName
     * @return array|mixed
     */
    public function getUploadFiles(string $inputName = '')
    {
        if ($inputName) {
            return $this->files[$inputName];
        }
        return $this->files;
    }


    /**
     * Создает обёртки для загружаемых файлов.
     */
    private function addUploadFiles(): void
    {
        if(count($_FILES) > 0) {
            foreach ($_FILES as $inputName => $file) {
                $this->files[$inputName] = new UploadFile(
                    $file['name'],
                    $file['type'],
                    $file['size'],
                    $file['tmp_name'],
                    $file['error']
                );
            }
        }
    }


    /**
     * Доступ к сессии. Если передан только ключ, возвращает значение.
     * Ксли передан ключ и значение, устанавливает значение. Иначе
     * просто возвращает сессию.
     * @param string $key
     * @param string $value
     * @return Session|string
     */
    public function session(string $key = '', string $value = '')
    {
        if($key && $value) {
            $this->session->$key = $value;
        } elseif ($key) {
            return $this->session->$key;
        }

        return $this->session;
    }
}