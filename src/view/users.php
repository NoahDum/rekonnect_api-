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
        // $data = $this->controller->getData();
        $result = $this->controller->addUser();
        require($this->template);
    }
}
