<?php

namespace App\Repositories;

interface JobInterface {

    public function getAllLatest();

    public function getById($jobId);

    public function create($jobData);

    public function findByUserId($userId);

    public function delete($jobId);

    public function search($request);

    public function getAllAppliedJobs($userId);

    public function update($jobData, $jobId);

}