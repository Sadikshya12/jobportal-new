<?php

namespace App\Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Job;

class JobTest extends TestCase
{

    public function testGetAllLatest()
    {
        $job = new Job();
        $latestJobs = $job->getAllLatest();

        if($latestJobs){
            $this->assertTrue(count($latestJobs) > 0);
        }

        $this->assertEquals(null, $latestJobs);
    }

    public function testGetById(){
        $job = new Job();
        $jobById = $job->getById(1);

        if($jobById){
            $this->assertArrayHasKey('id', $jobById);
        }

        $this->assertEquals(null, $jobById);

    }

}