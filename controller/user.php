<?php

class User extends Controller
{

    /**
     * @return bool
     */
    public function create(): bool
    {
        $data = $this->getContent();

        if ($data->create) {

            $user = $data->user;
            $model = $this->model('userModel');
            $createUser = $model->Create($user);

            if ($createUser) {
                echo 'created';
            } else {
                echo 'error';
            }

        }

        return false;
    }

    /**
     * @param int $id
     * @return false
     */
    public function delete(int $id): bool
    {
        return $this->model('userModel')->Delete($id);
    }

}