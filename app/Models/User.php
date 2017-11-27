<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Session;

class User extends Model {

    public $table = "user_tbl";

    public function __construct() {
        parent::__construct();
    }

    public function isLoggedIn()
    {
        $session = new Session();
        if($session->get('_logged_in_user_id')){
            return true;
        }

        return false;
    }

}

?>