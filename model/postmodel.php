<?php

use JetBrains\PhpStorm\ArrayShape;

class PostModel extends Model
{

    /**
     * @param stdClass $data
     * @return bool
     */
    public function Create(stdClass $data): bool
    {
        $query = $this->db->prepare('INSERT INTO posts SET title = :title, content = :content, post_slug = :pslug, post_Main_image = :pmi, post_category_id = :post_category_id, post_user_id = :post_user_id');
        $insert = $query->execute([
            'title' => (string) $data->title,
            'content' => (string) $data->content,
            'pslug' => $this->PostSlug($data->title),
            'pmi' => (string) $data->img->main,
            'post_category_id' => (int) $data->categoryID,
            'post_user_id' => (int) $data->authorID
        ]);

        if ($insert)
            return true;
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function Delete(int $id): bool
    {
        if ($this->CheckPostID($id)) {
            $query = $this->db->prepare('DELETE FROM posts WHERE post_id = :id');
            $delete = $query->execute([
                'id' => $id
            ]);

            if ($delete)
                return true;
        }

        return false;
    }

    /**
     * @return bool|array
     */
    public function getAllPosts(): bool|array
    {
        $query = $this->db->prepare('SELECT post_id, title, content, post_slug, post_Main_image, created_post, category_name, category_slug, user_id, first_name, last_name, username, email, verified FROM posts AS p INNER JOIN category AS c ON p.post_category_id = c.category_id INNER JOIN users AS u ON p.post_user_id = u.user_id ORDER BY p.post_id DESC');
        $query->execute();

        $details = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($details as $detail)
        {
            $detail->comment = $this->getPostComments($detail->post_id);
        }

        return $details;
    }

    /**
     * @param int $id
     * @return mixed
     */
    protected function getPostDetails(int $id): mixed
    {
        $query = $this->db->prepare('SELECT post_id, title, content, post_Main_image, created_post, category_name, first_name, last_name, username, email, verified FROM posts AS p INNER JOIN category AS c ON p.post_category_id = c.category_id INNER JOIN users AS u ON p.post_user_id = u.user_id WHERE post_id = :id');
        $query->execute([
            'id' => $id
        ]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param int $id
     * @return array|false
     */
    protected function getPostComments(int $id): bool|array
    {
        $query = $this->db->prepare('SELECT comment_id, comment_Content, created_comment, user_id, first_name, last_name, username FROM comments as co INNER JOIN users as u ON co.comment_User_id = u.user_id INNER JOIN posts as p ON co.comment_Post_id = p.post_id WHERE p.post_id = :id ORDER BY co.comment_id DESC');
        $query->execute([
            'id' => $id
        ]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param int $id
     * @return array
     */
    #[ArrayShape(['details' => "mixed", 'comments' => "array|bool"])] public function getPost(int $id): array
    {
        $details = $this->getPostDetails($id);
        $comments = $this->getPostComments($id);

        return [
            'details' => $details,
            'comments' => $comments
        ];
    }

    /**
     * @return array|false
     */
    public function getAllTitle(): bool|array
    {
        $query = $this->db->prepare('SELECT title FROM posts');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}