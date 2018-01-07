<?php

namespace App\Repositories;

interface ApplicationInterface {

    public function insert($data);

    public function findByJobAndUserId($jobId, $userId);

    public function update($appData, $condition);

    public function findById($applicationId);

    public function getAllReceivedApplications($userId);

}