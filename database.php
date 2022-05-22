<?php

class Database
{

    protected PDO $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=comment_system;charset=utf8', 'root', 'root');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}