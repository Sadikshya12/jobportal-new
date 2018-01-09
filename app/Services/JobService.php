<?php

namespace App\Services;

use App\Repositories\ApplicationInterface;
use App\Repositories\JobInterface;

class JobService
{

    protected $job;
    protected $application;

    public function __construct(
        JobInterface $jobRepository,
        ApplicationInterface $applicationRepository = null
    )
    {
        $this->job = $jobRepository;
        $this->application = $applicationRepository;
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
        if ($job->user_id != $loggedInUserId) {
            throw new \Exception('Sorry you are not authorized to delete this booking.');
        }

        return $this->job->delete($jobId);
    }

    public function search($request)
    {
        return $this->job->search($request);
    }

    public function apply($jobId, $userId)
    {

        if($this->application->findByJobAndUserId($jobId, $userId)){
            throw new \Exception('Job already applied.');
        }

        $appData = [
            'job_id' => $jobId,
            'user_id' => $userId,
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->application->insert($appData);
    }

    public function getAllAppliedJobs($userId)
    {
        return $this->job->getAllAppliedJobs($userId);
    }

    public function cancel($request, $jobId, $userId)
    {

        $application = $this->application->findByJobAndUserId($jobId, $userId);
        if(!$application){
            throw new \Exception('Application not found.');
        }

        $appData = [
            'status' => 'cancelled',
            'cancel_reason' => $request['cancel_reason']
        ];

        return $this->application->update($appData, [
            'id' => $application->id
        ]);
    }

    public function getAllReceivedApplications($userId)
    {
        return $this->application->getAllReceivedApplications($userId);
    }

    public function updateApplicationStatus($status, $applicationId)
    {
        return $this->application->update([
            'status' => $status
        ], [
            'id' => $applicationId
        ]);
    }

    public function updateJob($request, $jobId)
    {
        $jobData = [
            'title' => $request['title'],
            'description' => $request['description'],
            'location' => $request['location']
        ];
        return $this->job->update($jobData, $jobId);
    }

}

?>