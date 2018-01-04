<?php

namespace App\Tests\Unit\Services;

use App\Repositories\UserInterface;
use App\Services\UserService;
//use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_TestCase;

class UserServiceTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerTestRegisterWithPostData
     */
    public function testRegisterWithPostData($userByUserName, $userByEmail, $password)
    {

        $userRepo = $this->mockRepo();
        $userRepo->method('findByUsername')
            ->willReturn($userByUserName);
        $userRepo->method('findByEmail')
            ->willReturn($userByEmail);

        $userRepo->method('create')
            ->willReturn(true);

        $userService = new UserService($userRepo);

        if($userByEmail || $userByUserName || strlen($password) < 6){
            $this->expectException(\Exception::class);
        }

        $result = $userService->registerWithPostData([
            'fname' => 'test',
            'sname' => 'test',
            'username' => 'test',
            'password' => $password,
            'email' => 'test',
            'address' => 'test',
            'country' => 'test',
            'user_type' => 'Job Seeker'
        ]);

        $this->assertTrue($result);
    }

    public function providerTestRegisterWithPostData(){
        return [
            [null, null, 'asdf'],
            [null, null, 'asdfas'],
            [true, null, 'asdfas'],
            [null, true, 'asdfas']
        ];
    }

    private function mockRepo()
    {
        return $this->getMockBuilder(UserInterface::class)
            ->setMethods([
                'findByUserEmailPass',
                'create',
                'findByUsername',
                'findByEmail',
                'findById'
            ])
            ->getMock();
    }

}