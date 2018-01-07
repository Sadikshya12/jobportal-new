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

    public function update($appData, $condition)
    {
        return $this->db
            ->update($appData, $condition);
    }

    public function findById($applicationId)
    {
        return $this->db
            ->where([
                'id' => $applicationId
            ])
            ->fetch_row();
    }

    public function getAllReceivedApplications($userId)
    {
        $sql = "select users.*, jobs.*, applications.* from applications";
        $sql .= " join jobs on jobs.id = applications.job_id";
        $sql .= " join users on users.id = applications.user_id";
        $sql .= " where jobs.user_id = $userId";

        return $this->db->raw_query($sql)->fetch_rows();
    }
}