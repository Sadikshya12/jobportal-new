<?php

namespace App\Repositories\Mysql;

use App\Core\Database;
use App\Core\Model;
use App\Repositories\ApplicationInterface;
use App\Repositories\UserInterface;

class MySQLApplicationRepository implements ApplicationInterface
{

    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        $this->db->table('applications');
    }

    public function insert($data)
    {
        return $this->db->insert($data);
    }

    public function findByJobAndUserId($jobId, $userId)
    {
        return $this->db
            ->where([
                'job_id' => $jobId,
                'user_id' => $userId
            ])
            ->fetch_row();
    }
}