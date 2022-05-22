<?php

class CategoryModel extends Model
{

    /**
     * @param stdClass $data
     * @return bool
     */
    public function Create(stdClass $data): bool
    {
        $query = $this->db->prepare('INSERT INTO category SET category_name = :cn, category_slug = :cs, category_user_id = :cui');
        $insert = $query->execute([
            'cn' => $data->name,
            'cs' => $this->CategorySlug($data->name),
            'cui' => (int) $data->userID
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
        if ($this->CheckCategoryID($id)) {
            $query = $this->db->prepare('DELETE FROM category WHERE category_id = :id');
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
    public function getAllName(): bool|array
    {
        return $this->db->query('SELECT category_name FROM category')->fetchAll(PDO::FETCH_OBJ);
    }

}