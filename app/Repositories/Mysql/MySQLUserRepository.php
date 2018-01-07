<?php

namespace App\Repositories\Mysql;

use App\Core\Database;
use App\Core\Model;
use App\Repositories\UserInterface;

class MySQLUserRepository implements UserInterface
{

    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->db->table('users');
    }

    public function findByUserEmailPass($username, $password)
    {
        $sql = "select * from users where (username='$username' or email = '$username') and password = '$password'";
        return $this->db
            ->raw_query($sql)
            ->fetch_row();
    }

    public function create($userData)
    {
        $this->db->insert($userData);

        return $this->db->last_insert_id();
    }

    public function findByUsername($username)
    {
        return $this->db
            ->where([
                'username' => $username
            ])
            ->fetch_row();
    }

    public function findByEmail($email)
    {
        return $this->db
            ->where([
                'email' => $email
            ])
            ->fetch_row();
    }

    public function findById($userId)
    {
        return $this->db->where([
            'id' => $userId
        ])->fetch_row();
    }

    public function update($data, $cond)
    {
        return $this->db->update($data, $cond);
    }
}