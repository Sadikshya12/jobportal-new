<?php

namespace App\Services;

use App\Core\Session;
use App\Repositories\ReviewInterface;
use App\Repositories\UserInterface;

class UserService
{

    protected $user;
    protected $review;

    public function __construct(
        UserInterface $userRepository,
        ReviewInterface $reviewRepository = null
    )
    {
        $this->user = $userRepository;
        $this->review = $reviewRepository;
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

        if ($this->user->findByUsername($post['username'])) {
            throw new \Exception('Username already exists.');
        }

        if ($this->user->findByEmail($post['email'])) {
            throw new \Exception('Email already exists.');
        }

        if (strlen($post['password']) < 6) {
            throw new \Exception('Password must be atleast 6 character long.');
        }

        return $this->user->create($userData);

    }

    public function loginWithPostData($post, Session $session)
    {
        if (!$this->user->findByEmail($post['username']) && !$this->user->findByUsername($post['username'])) {
            throw new \Exception('User is not registered with this email/username.');
        }

        $user = $this->user->findByUserEmailPass($post['username'], $post['password']);
        if (!$user) {
            throw new \Exception('Username/Password do not match.');
        }

        return $session->set('logged_in_user_id', $user->id);
    }

    public function findById($userId)
    {
        return $this->user->findById($userId);
    }

    public function isJobSeeker($userId)
    {
        $user = $this->user->findById($userId);
        if ($user->user_type == 'Job Seeker') {
            return true;
        }

        return false;
    }

    public function isJobPoster($userId)
    {
        $user = $this->user->findById($userId);
        if ($user->user_type == 'Job Poster') {
            return true;
        }

        return false;
    }

    public function createReview($review_text, $for_user_id, $by_user_id)
    {
        $reviewData = [
            'review_text' => $review_text,
            'for_user_id' => $for_user_id,
            'by_user_id' => $by_user_id
        ];

        return $this->review->insert($reviewData);
    }

    public function getAllReviewsReceived($userId)
    {
        return $this->review->getAllByToUserId($userId);
    }

    public function uploadPhoto($files, $userId)
    {

        $user = $this->findById($userId);
        if(!$user){
            throw new \Exception('Invalid user id.');
        }

        if($user->photo && file_exists('uploads'.DIRECTORY_SEPARATOR.$user->photo)){
            unlink('uploads'.DIRECTORY_SEPARATOR.$user->photo);
        }

        $tmp_name = $files['photo']['tmp_name'];
        $name = $files['photo']['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $newFileName = date('YmdHis').".".$ext;

        move_uploaded_file($tmp_name, 'uploads'.DIRECTORY_SEPARATOR.$newFileName);

        return $this->user->update([
            'photo' => $newFileName
        ], [
            'id' => $userId
        ]);
    }

    public function update($request, $user)
    {

        $u = $this->user->findByUsername($request['username']);
        if ($u && $u->id != $user->id) {
            throw new \Exception('Username already exists.');
        }

        $u = $this->user->findByEmail($request['email']);
        if ($u && $u->id != $user->id) {
            throw new \Exception('Email already exists.');
        }

        $userData = [
            'first_name' => $request['first_name'],
            'second_name' => $request['second_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'address' => $request['address'],
            'country' => $request['country']
        ];

        return $this->user->update($userData, [
            'id' => $user->id
        ]);

    }
}

?>