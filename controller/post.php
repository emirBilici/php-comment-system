<?php

class Post extends Controller
{

    /**
     * @return bool
     */
    public function create(): bool
    {
        $data = $this->getContent();

        if ($data->create) {

            $post = $data->post;
            $model = $this->model('postModel');
            $createPost = $model->Create($post);

            if ($createPost) {
                echo 'Created..';
            } else {
                echo 'error!';
            }

        }

        return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id): mixed
    {
        return $this->model('postModel')->Delete($id);
    }

    /**
     * @return void
     */
    public function getAll()
    {
        $model = $this->model('postModel');
        $posts = $model->getAllPosts();

        $this->JsonOutput((object) $posts);
    }

    /**
     * @param int $id
     * @return void
     */
    public function get(int $id)
    {
        $model = $this->model('postModel');
        $post = $model->getPost($id);

        $this->JsonOutput((object) $post);
    }

    /**
     * @param int $id
     * @return void
     */
    public function viewPost(int $id)
    {
        $model = $this->model('postModel');
        $post = $model->getPost($id);

        $this->view('post/view', [
            'data' => $post
        ]);
    }

}