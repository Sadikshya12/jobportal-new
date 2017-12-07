<?php

namespace App\Tests\Unit\Models;

use App\Core\Session;
use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function testIsLoggedIn(){
        $user = new User();

        $session = new Session();
        $session->set('_logged_in_user_id', true);
        $result = $user->isLoggedIn($session);
        $this->assertTrue(is_bool($result));

        $session = new Session();
        $session->set('_logged_in_user_id', false);
        $result = $user->isLoggedIn($session);
        $this->assertTrue(is_bool($result));
    }

}