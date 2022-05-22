<?php

class Controller
{

    /**
     * @param $name
     * @param array $data
     * @return void
     */
    protected function view($name, array $data = [])
    {
        extract($data);
        require __DIR__ . '/view/' . strtolower($name) . '.php';
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function model($name): mixed
    {
        require __DIR__ . '/model/' . strtolower($name) . '.php';
        return new $name();
    }

    /**
     * @return mixed
     */
    protected function getContent(): mixed
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        return $data;
    }

    /**
     * @param object $data
     * @return void
     */
    protected function JsonOutput(object $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

}