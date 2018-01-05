<?php

namespace App\Repositories\Mysql;

use App\Core\Database;
use App\Repositories\JobInterface;

class MySQLJobRepository implements JobInterface
{

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

    public function search($request)
    {

        $conditions = [];

        $this->db->select('*');

        if (isset($request['title'])) {
            $conditions['title LIKE'] = "%".$request['title']."%";
        }

        if (isset($request['location'])) {
            $conditions['location LIKE'] = "%".$request['location']."%";
        }

        $this->db->where($conditions);

        $result = $this->db->fetch_rows();

        return $result;

    }

    public function getAllAppliedJobs($userId)
    {
        $sql = "SELECT jobs.* FROM jobs";
        $sql .= " JOIN applications ON applications.job_id = jobs.id";
        $sql .= " WHERE applications.user_id = $userId";

        $result = $this->db->raw_query($sql)->fetch_rows();
        return $result;
    }

}