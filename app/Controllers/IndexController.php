<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\User;

class IndexController extends Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    public function index()
    {
        return $this->render('home');
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

            $user = $this->user
                ->where([
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ])
                ->fetch_row();

            if (!$user) {
                set_flash('danger', 'Invalid username/password.');
                $this->redirect('/index/login');
            }

            $this->session->set('logged_in_user_id', $user->id);
            $this->redirect('/user/myaccount');

        }

        return $this->render('login');
    }

    public function register()
    {
        if ($_POST) {

            $userData = [
                'first_name' => $_POST['fname'],
                'second_name' => $_POST['sname'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'country' => $_POST['country'],
                'user_type' => $_POST['user_type']
            ];

            $this->user->insert($userData);
            set_flash('success', 'Register success.');
            $this->redirect('/index/login');

        }

        return $this->render('register');
    }


}