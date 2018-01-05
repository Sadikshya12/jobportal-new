<?php

namespace App\Repositories\Mysql;

use App\Core\Database;
use App\Core\Model;
use App\Repositories\ReviewInterface;

class MySQLReviewRepository implements ReviewInterface
{

    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->db->table('reviews');
    }

    public function insert($data)
    {
        return $this->db->insert($data);
    }

    public function getAllByToUserId($userId)
    {
        $sql = "select users.*, reviews.* from reviews";
        $sql .= " join users on users.id = reviews.by_user_id";
        $sql .= " where reviews.for_user_id = $userId";

        return $this->db->raw_query($sql)->fetch_rows();

    }
}