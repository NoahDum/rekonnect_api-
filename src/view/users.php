<?php


class UsersView
{

    private $controller;
    private $template;


    public function __construct(UsersController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . "users.php";
    }
    public function render()
    {
        $result = $this->controller->addUser();
        require($this->template);
    }
}
