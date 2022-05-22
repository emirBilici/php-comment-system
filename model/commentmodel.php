<?php

class CommentModel extends Model
{

    /**
     * @param stdClass $data
     * @return bool
     */
    public function Create(stdClass $data): bool
    {
        $query = $this->db->prepare('INSERT INTO comments SET comment_Content = :content, comment_User_id = :userID, comment_Post_id = :postID');
        $insert = $query->execute([
            'content' => $data->content,
            'userID' => (int) $data->userID,
            'postID' => (int) $data->postID
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
        $query = $this->db->prepare('DELETE FROM comments WHERE comment_id = :id');
        $delete = $query->execute([
            'id' => $id
        ]);

        if ($delete)
            return true;
        return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getComment(int $id): mixed
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE comment_id = :id');
        $query->execute([
            'id' => $id
        ]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

}