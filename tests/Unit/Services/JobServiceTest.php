<?php

namespace App\Tests\Unit\Services;

use App\Repositories\JobInterface;
use App\Repositories\Mysql\MySQLJobRepository;
use App\Services\JobService;
use PHPUnit_Framework_TestCase;


class JobServiceTest extends PHPUnit_Framework_TestCase
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

        $this->assertEquals(1, $this->count($latestJobs));

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

    public function testPostNewJob(){

        $jobRepo = $this->mockRepo();
        $jobRepo->method('create')
            ->willReturn(true);

        $job = new JobService($jobRepo);
        $result = $job->postNewJob([
            'title' => 'hello',
            'description' => 'world',
            'location' => 'test',
        ], 1);

        $this->assertTrue($result);
    }

    public function testGetByUserId(){

        $row = new \stdClass();
        $row->id = 1;
        $row->name = 'test';
        $result = [$row];

        // Mock job repo
        $jobRepo = $this->mockRepo();
        $jobRepo->method('findByUserId')
            ->willReturn($result);

        $job = new JobService($jobRepo);
        $result = $job->getByUserId(1);

        $this->assertEquals(1, $this->count($result));
    }

    public function testDelete(){

        $row = new \stdClass();
        $row->id = 1;
        $row->user_id = 1;

        $jobRepo = $this->mockRepo();
        $jobRepo->method('delete')
            ->willReturn(true);
        $jobRepo->method('getById')
            ->willReturn($row);

        $job = new JobService($jobRepo);
        $result = $job->delete(1, 1);

        $this->assertTrue($result);
    }

    public function testDeleteException(){

        $row = new \stdClass();
        $row->id = 1;
        $row->user_id = 2;

        $jobRepo = $this->mockRepo();
        $jobRepo->method('delete')
            ->willReturn(true);
        $jobRepo->method('getById')
            ->willReturn($row);

        $job = new JobService($jobRepo);

        $this->expectException(\Exception::class);
        $job->delete(1, 1);

    }

    private function mockRepo(){
        return $this->getMockBuilder(JobInterface::class)
            ->setMethods([
                'getAllLatest',
                'getById',
                'create',
                'findByUserId',
                'delete'
            ])
            ->getMock();
    }

}