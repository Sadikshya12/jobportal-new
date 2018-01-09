<?php

namespace App\Tests\Unit\Services;

use App\Repositories\JobInterface;
use App\Repositories\Mysql\MySQLJobRepository;
use App\Services\JobService;
use PHPUnit_Framework_TestCase;


class JobServiceTest extends PHPUnit_Framework_TestCase
{
    protected $mockedJobRepo;

    protected function setUp()
    {
        parent::setUp();
        $this->mockedJobRepo = $this->createMock(JobInterface::class);
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->mockedJobRepo);
    }

    public function testGetAllLatest()
    {

        $row = new \stdClass();
        $row->id = 1;
        $row->name = 'test';
        $result = [$row];

        // Mock job repo
        $this->mockedJobRepo
            ->method('getAllLatest')
            ->willReturn($result);

        $job = new JobService($this->mockedJobRepo);
        $latestJobs = $job->getAllLatest();

        $this->assertEquals(1, $this->count($latestJobs));

    }

    public function testGetById()
    {

        $row = new \stdClass();
        $row->id = 1;
        $row->name = 'test';

        $this->mockedJobRepo
            ->method('getById')
            ->willReturn($row);

        $job = new JobService($this->mockedJobRepo);
        $jobById = $job->getById(1);

        $this->assertObjectHasAttribute('id', $jobById);
    }

    public function testPostNewJob()
    {

        $this->mockedJobRepo
            ->method('create')
            ->willReturn(true);

        $job = new JobService($this->mockedJobRepo);
        $result = $job->postNewJob([
            'title' => 'hello',
            'description' => 'world',
            'location' => 'test',
        ], 1);

        $this->assertTrue($result);
    }

    public function testGetByUserId()
    {

        $row = new \stdClass();
        $row->id = 1;
        $row->name = 'test';
        $result = [$row];

        // Mock job repo
        $this->mockedJobRepo
            ->method('findByUserId')
            ->willReturn($result);

        $job = new JobService($this->mockedJobRepo);
        $result = $job->getByUserId(1);

        $this->assertEquals(1, $this->count($result));
    }

    public function testDelete()
    {

        $row = new \stdClass();
        $row->id = 1;
        $row->user_id = 1;

        $this->mockedJobRepo
            ->method('delete')
            ->willReturn(true);

        $this->mockedJobRepo
            ->method('getById')
            ->willReturn($row);

        $job = new JobService($this->mockedJobRepo);
        $result = $job->delete(1, 1);

        $this->assertTrue($result);
    }

    public function testDeleteException()
    {

        $row = new \stdClass();
        $row->id = 1;
        $row->user_id = 2;

        $this->mockedJobRepo
            ->method('delete')
            ->willReturn(true);

        $this->mockedJobRepo
            ->method('getById')
            ->willReturn($row);

        $job = new JobService($this->mockedJobRepo);

        $this->expectException(\Exception::class);
        $job->delete(1, 1);

    }


}