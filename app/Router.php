<?php

namespace App;

class Router {

    const DEFAULT_CONTROLLER = "IndexController";
    const DEFAULT_ACTION     = "index";

    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $basePath      = '';

    public function __construct(array $options = array()) {

        $this->basePath = config('app.base_path');

        if (empty($options)) {
            $this->parseUri();
        }
        else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }

    protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $path = preg_replace('[^a-zA-Z0-9]', "", $path);
        if (strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }

        @list($controller, $action, $params) = explode("/", $path, 3);

        if ($controller) {
            $this->setController($controller);
        }
        if ($action) {
            $this->setAction($action);
        }
        if ($params) {
            $this->setParams(explode("/", $params));
        }
    }

    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists(__NAMESPACE__."\\Controllers\\".$controller)) {
            die("Controller $controller not found.");
        }
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action) {
        $reflector = new \ReflectionClass(__NAMESPACE__."\\Controllers\\".$this->controller);
        if (!$reflector->hasMethod($action)) {
            die("Function <b>$action()</b> not found in <b>$this->controller</b>.");
        }
        $this->action = $action;
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function run() {
        $context = __NAMESPACE__."\\Controllers\\".$this->controller;
        call_user_func_array([new $context(), $this->action], $this->params);
    }
}