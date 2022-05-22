<?php

class CommentPost extends Controller
{

    public function index(int $id)
    {
        $postModel = $this->model('postModel');
        $checkPost = $postModel->getPost($id);

        if (!$checkPost['details']) {
            die('No post!');
        } else {
            header('Location: ' . site_url('getComments/?id=' . $id));
            exit();
        }
    }

}