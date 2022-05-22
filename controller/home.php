<?php

class Home extends Controller
{

    public function index()
    {
        $models = [
            'post' => $this->model('postModel'),
            'user' => $this->model('userModel'),
            'category' => $this->model('categoryModel')
        ];

        $this->view('homeView', [
            'posts' => $models['post']->getAllTitle(),
            'users' => $models['user']->getAllName(),
            'categories' => $models['category']->getAllName()
        ]);
    }

}