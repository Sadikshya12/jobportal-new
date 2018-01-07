<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Database;
use App\Core\Model;
use App\Core\Session;
use App\Repositories\Mysql\MySQLJobRepository;
use App\Repositories\Mysql\MySQLUserRepository;
use App\Services\JobService;
use App\Services\UserService;

class IndexController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService(new MySQLUserRepository(new Database()));
        $this->jobService = new JobService(new MySQLJobRepository(new Database()));
    }

    public function index()
    {
        $jobs = $this->jobService->getAllLatest();
        $view_data['jobs'] = $jobs;
        return $this->render('home', $view_data);
    }

    public function contact()
    {

        if ($_POST) {
            $name = strip_tags(trim($_POST["name"]));
            $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
            $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $message = trim($_POST["message"]);

            // Check that data was sent to the mailer.
            if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                set_flash('danger', "Oops! There was a problem with your submission. Please complete the form and try again.");
                $this->redirect('/index/contact');
            }

            // Set the recipient email address.
            // FIXME: Update this to your desired email address.
            $recipient = "21336572@studnet.uwl.ac.uk";

            // Set the email subject.
            $subject = "New contact from $name";

            // Build the email content.
            $email_content = "Name: $name\n";
            $email_content .= "Email: $email\n\n";
            $email_content .= "Message:\n$message\n";

            // Build the email headers.
            $email_headers = "From: $name <$email>";

            // Send the email.
            if (!mail($recipient, $subject, $email_content, $email_headers)) {
                set_flash('danger', "Oops! Something went wrong and we could not send your message.");
                $this->redirect('/index/contact');
            }

            set_flash('success', "Thank You! Your message has been sent.");
            $this->redirect('/index/contact');
        }

        return $this->render('contact');
    }

    public function login()
    {

        if (isLoggedIn()) {
            $this->redirect('/user/myaccount');
        }

        if ($_POST) {
            try {
                $this->userService->loginWithPostData($_POST, new Session());
                $this->redirect('/user/myaccount');
            } catch (\Exception $e) {
                set_flash('danger', $e->getMessage());
                $this->redirect('/index/login');
            }
        }

        return $this->render('login');
    }

    public function register()
    {
        if ($_POST) {
            try {
                $userId = $this->userService->registerWithPostData($_POST);
                $this->userService->uploadPhoto($_FILES, $userId);

                set_flash('success', 'Register success.');
                $this->redirect('/index/login');
            } catch (\Exception $e) {
                set_inputs($_POST);
                set_flash('danger', $e->getMessage());
                $this->redirect('/index/register');
            }
        }

        return $this->render('register');
    }


}