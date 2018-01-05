<?php

namespace App\Repositories;

interface ReviewInterface {

    public function insert($data);

    public function getAllByToUserId($userId);
}