<?php
namespace App\Models;

use App\Core\Model;

class Job extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllLatest(){
        $sql = "select * from jobs";
        $data = $this->raw_query($sql)->fetch_rows();
        return $data;
    }

    public function getById($jobId){
        $sql = "select * from jobs where id = $jobId";
        $data = $this->raw_query($sql)->fetch_row();
        return $data;
    }

}

?>