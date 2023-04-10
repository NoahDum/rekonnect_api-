<?php


class LoginView
{
    private $controller;
    private $template;

    public function __construct(LoginController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . "login.php";
    }
    public function render()
    {
        $user = $this->controller->connect();
        require($this->template);
    }
}
