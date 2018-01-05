<?php

namespace App\Services;

use App\Repositories\JobInterface;

class JobService
{

    protected $job;

    public function __construct(JobInterface $jobRepository)
    {
        $this->job = $jobRepository;
    }

    public function getAllLatest()
    {
        return $this->job->getAllLatest();
    }

    public function getById($jobId)
    {
        return $this->job->getById($jobId);
    }

    public function postNewJob($post, $loggedInUserId)
    {
        $jobData = [
            'user_id' => $loggedInUserId,
            'title' => $post['title'],
            'description' => $post['description'],
            'location' => $post['location'],
        ];

        return $this->job->create($jobData);

    }

    public function getByUserId($userId)
    {
        return $this->job->findByUserId($userId);
    }

    public function delete($jobId, $loggedInUserId)
    {

        $job = $this->job->getById($jobId);
        if($job->user_id != $loggedInUserId){
            throw new \Exception('Sorry you are not authorized to delete this booking.');
        }

        return $this->job->delete($jobId);
    }

    public function search($request)
    {
        return $this->job->search($request);
    }

}

?>