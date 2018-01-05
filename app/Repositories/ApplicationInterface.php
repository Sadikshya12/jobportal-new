<?php

namespace App\Repositories;

interface ApplicationInterface {

    public function insert($data);

    public function findByJobAndUserId($jobId, $userId);

}