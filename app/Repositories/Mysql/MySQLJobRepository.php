<?php

namespace App\Repositories\Mysql;

use App\Core\Database;
use App\Repositories\JobInterface;

class MySQLJobRepository implements JobInterface {

    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->db->table('jobs');
    }

    public function getAllLatest()
    {
        $sql = "select * from jobs";
        $data = $this->db->raw_query($sql)->fetch_rows();
        return $data;
    }

    public function getById($jobId)
    {
        $sql = "select * from jobs where id = $jobId";
        $data = $this->db->raw_query($sql)->fetch_row();
        return $data;
    }

    public function create($jobData)
    {
        return $this->db->insert($jobData);
    }

    public function findByUserId($userId)
    {
        return $this->db
            ->where([
                'user_id' => $userId
            ])
            ->fetch_rows();
    }

    public function delete($jobId)
    {
        return $this->db->delete($jobId);
    }
}