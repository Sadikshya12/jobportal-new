<?php

namespace App\Tests\Unit\Services;

use App\Core\Database;
use App\Core\Session;
use PHPUnit\Framework\TestCase;
use App\Services\UserService;

class UserServiceTest extends TestCase
{

//    public function testIsLoggedIn(){
//        $user = new UserService($this->mockDb());
//
//        $session = new Session();
//        $session->set('_logged_in_user_id', true);
//        $result = $user->isLoggedIn($session);
//        $this->assertTrue(is_bool($result));
//
//        $session = new Session();
//        $session->set('_logged_in_user_id', false);
//        $result = $user->isLoggedIn($session);
//        $this->assertTrue(is_bool($result));
//    }
//
//    private function mockDb(){
//
//        $stub = $this->getMockBuilder(Database::class)
//            ->disableOriginalConstructor()
//            ->setMethods(['query'])
//            ->getMock();
//
//        return $stub;
//    }

}