<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Repositories\Mysql\MySQLReviewRepository;
use App\Repositories\Mysql\MySQLUserRepository;
use App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct()
    {
        parent::__construct();
        if (!isLoggedIn()) {
            set_flash('danger', 'you need to be logged in.');
            $this->redirect('/index/login');
        }

        $this->userService = new UserService(
            new MySQLUserRepository(new Database()),
            new MySQLReviewRepository(new Database())
        );
    }

    public function index()
    {
        return $this->render('user');
    }

    public function myaccount()
    {
        $user = $this->userService->findById($this->session->get('logged_in_user_id'));

        $view_data['user'] = $user;
        return $this->render('user/myaccount', $view_data);
    }

    public function logout()
    {
        $this->session->remove('logged_in_user_id');
        set_flash('success', 'Logout success.');
        $this->redirect('/index/login');
    }

    public function review($userId)
    {

        $jobPoster = $this->userService->findById($userId);
        if (!$jobPoster) {
            die('Job poster not found. Invalid job poster id.');
        }

        if ($_POST) {
            try {
                $this->userService->createReview(
                    $_POST['review_text'],
                    $jobPoster->id,
                    $this->session->get('logged_in_user_id')
                );
            } catch (\Exception $e) {
                set_flash('danger', $e->getMessage());
                return $this->redirect('/user/review/' . $jobPoster->id);
            }

            set_flash('success', 'Review posted.');
            $this->redirect('/user/reviews/' . $jobPoster->id);
        }

        $view_data['jobPoster'] = $jobPoster;
        return $this->render('user/review', $view_data);
    }

    public function edit()
    {
        $user = $this->userService->findById($this->session->get('logged_in_user_id'));
        if (!$user) {
            die('User not found. Invalid user id.');
        }

        if ($_POST) {

            try {

                $this->userService->update($_POST, $user);

                if (isset($_FILES['photo']['name']) && $_FILES['photo']['name']) {
                    $this->userService->uploadPhoto($_FILES, $user->id);
                }

                set_flash('success', 'Profile updated.');
                $this->redirect('/user/myaccount');

            } catch (\Exception $e) {
                set_flash('danger', $e->getMessage());
                $this->redirect('/user/edit');
            }
        }

        $view_data['user'] = $user;
        return $this->render('user/edit', $view_data);
    }

    public function password(){
        $user = $this->userService->findById($this->session->get('logged_in_user_id'));
        if (!$user) {
            die('User not found. Invalid user id.');
        }

        if ($_POST) {

            try {

                $this->userService->changePassword($_POST, $user);

                set_flash('success', 'Password updated.');
                $this->redirect('/user/myaccount');

            } catch (\Exception $e) {
                set_flash('danger', $e->getMessage());
                $this->redirect('/user/password');
            }
        }

        $view_data['user'] = $user;
        return $this->render('user/password', $view_data);
    }

}
