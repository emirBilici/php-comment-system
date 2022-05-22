<?php

class UserModel extends Model
{

    /**
     * @param stdClass $data
     * @return bool
     */
    public function Create(stdClass $data): bool
    {
        $data->password = $this->encryptPass($data->password);

        $query = $this->db->prepare('INSERT INTO users SET first_name = :first_name, last_name = :last_name, username = :username, email = :email, password = :password, birthday = :birthday, security_question = :security_question, question_answer = :question_answer, user_type = :user_type, verified = :verified');
        $insert = $query->execute([
            'first_name' => $data->firstName,
            'last_name' => $data->lastName,
            'username' => $data->username,
            'email' => $data->email,
            'password' => $data->password,
            'birthday' => $data->birthday,
            'security_question' => (int) $data->question->number,
            'question_answer' => $data->question->answer,
            'user_type' => (int) $data->userType,
            'verified' => (int) $data->verified
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
        if ($this->CheckUserID($id)) {
            $query = $this->db->prepare('DELETE FROM users WHERE user_id = :id');
            $delete = $query->execute([
                'id' => $id
            ]);

            if ($delete)
                return true;
        }

        return false;
    }

    /**
     * @return array|false
     */
    public function getAllName(): bool|array
    {
        return $this->db->query('SELECT first_name FROM users')->fetchAll(PDO::FETCH_OBJ);
    }

}