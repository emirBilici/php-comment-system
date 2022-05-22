<?php

class Category extends Controller
{

    /**
     * @return bool
     */
    public function create(): bool
    {
        $data = $this->getContent();

        if ($data->create) {

            $category = $data->category;
            $model = $this->model('categoryModel');
            $createCategory = $model->Create($category);

            if ($createCategory) {
                echo 'Created..';
                return true;
            } else {
                echo 'error';
                return false;
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
        return $this->model('categoryModel')->Delete($id);
    }

}