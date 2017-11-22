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