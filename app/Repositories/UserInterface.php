<?php

namespace App\Repositories;

interface UserInterface {

    public function findByUserEmailPass($username, $password);

    public function create($userData);

    public function findByUsername($username);

    public function findByEmail($email);

    public function findById($userId);
}