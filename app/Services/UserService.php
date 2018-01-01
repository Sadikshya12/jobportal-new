<?php

namespace App\Services;

use App\Core\Session;
use App\Repositories\UserInterface;

class UserService
{

    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function registerWithPostData($post)
    {

        $userData = [
            'first_name' => $post['fname'],
            'second_name' => $post['sname'],
            'username' => $post['username'],
            'password' => $post['password'],
            'email' => $post['email'],
            'address' => $post['address'],
            'country' => $post['country'],
            'user_type' => $post['user_type']
        ];

        if($this->user->findByUsername($post['username'])){
            throw new \Exception('Username already exists.');
        }

        if($this->user->findByEmail($post['email'])){
            throw new \Exception('Email already exists.');
        }

        if(strlen($post['password']) < 6){
            throw new \Exception('Password must be atleast 6 character long.');
        }

        return $this->user->create($userData);

    }

    public function loginWithPostData($post, Session $session)
    {
        if(!$this->user->findByEmail($post['username']) && !$this->user->findByUsername($post['username'])){
            throw new \Exception('User is not registered with this email/username.');
        }

        $user = $this->user->findByUserEmailPass($post['username'], $post['password']);
        if(!$user){
            throw new \Exception('Username/Password do not match.');
        }

        return $session->set('logged_in_user_id', $user->id);
    }

    public function findById($userId)
    {
        return $this->user->findById($userId);
    }

    public function isJobSeeker($userId){
        $user = $this->user->findById($userId);
        if($user->user_type == 'Job Seeker'){
            return true;
        }

        return false;
    }

    public function isJobPoster($userId){
        $user = $this->user->findById($userId);
        if($user->user_type == 'Job Poster'){
            return true;
        }

        return false;
    }
}

?>