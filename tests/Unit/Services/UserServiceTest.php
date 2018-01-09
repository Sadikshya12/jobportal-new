<?php

namespace App\Tests\Unit\Services;

use App\Repositories\UserInterface;
use App\Services\UserService;
//use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_TestCase;

class UserServiceTest extends PHPUnit_Framework_TestCase
{
    protected $mockedUserRepo;

    protected function setUp()
    {
        parent::setUp();
        $this->mockedUserRepo = $this->createMock(UserInterface::class);
    }

    protected function tearDown()
    {
        parent::tearDown();
        unset($this->mockedUserRepo);
    }

    /**
     * @dataProvider providerTestRegisterWithPostData
     */
    public function testRegisterWithPostData($userByUserName, $userByEmail, $password)
    {

        $this->mockedUserRepo
            ->method('findByUsername')
            ->willReturn($userByUserName);

        $this->mockedUserRepo
            ->method('findByEmail')
            ->willReturn($userByEmail);

        $this->mockedUserRepo
            ->method('create')
            ->willReturn(true);

        $userService = new UserService($this->mockedUserRepo);

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



}