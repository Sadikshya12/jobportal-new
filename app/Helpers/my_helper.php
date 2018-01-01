<?php

function debug($data, $isExit = true)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($isExit)
        die;
}

function config($args)
{

    $args = explode('.', $args);

    $config = include '.' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $args[0] . '.php';
    return $config[$args[1]];
}

function set_flash($type, $message)
{
    $session = new \App\Core\Session();
    $session->set('flash', [
        'type' => $type,
        'msg' => $message
    ]);
}

function display_flash(){
    $session = new \App\Core\Session();
    $flash = $session->get('flash');

    if(!$flash){
        return;
    }

    echo '<div class="alert alert-'.$flash['type'].'">';
    echo $flash['msg'];
    echo '</div>';

    $session->remove('flash');
}

function isLoggedIn(){
    $session = new \App\Core\Session();
    if($session->get('logged_in_user_id')){
        return true;
    }

    return false;
}

function set_inputs($request){
    $session = new \App\Core\Session();
    $session->set('inputs', $request);
}

function input($field){
    $session = new \App\Core\Session();
    $inputs = $session->get('inputs');

    if(isset($inputs[$field])){
        $val = $inputs[$field];

        unset($inputs[$field]);
        $session->set('inputs', $inputs);

        return $val;
    }
}