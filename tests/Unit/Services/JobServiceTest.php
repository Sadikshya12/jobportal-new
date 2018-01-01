<?php

namespace App\Tests\Unit\Services;

use App\Repositories\JobInterface;
use App\Repositories\Mysql\MySQLJobRepository;
use PHPUnit\Framework\TestCase;
use App\Services\JobService;

class JobServiceTest extends TestCase
{

    public function testGetAllLatest()
    {

        $row = new \stdClass();
        $row->id = 1;
        $row->name = 'test';
        $result = [$row];

        // Mock job repo
        $jobRepo = $this->mockRepo();
        $jobRepo->method('getAllLatest')
            ->willReturn($result);

        $job = new JobService($jobRepo);
        $latestJobs = $job->getAllLatest();

        $this->assertObjectHasAttribute('id', $latestJobs[0]);

    }

    public function testGetById(){

        $row = new \stdClass();
        $row->id = 1;
        $row->name = 'test';

        $jobRepo = $this->mockRepo();
        $jobRepo->method('getById')
            ->willReturn($row);

        $job = new JobService($jobRepo);
        $jobById = $job->getById(1);

        $this->assertObjectHasAttribute('id', $jobById);
    }

    private function mockRepo(){
        return $this->getMockBuilder(JobInterface::class)
            ->setMethods(['getAllLatest', 'getById'])
            ->getMock();
    }

}