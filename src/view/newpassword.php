<?php

class NewPasswordView
{

    private $controller;
    private $template;
    public function __construct(NewPasswordController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . "newpassword.php";
    }
    public function render()
    {
        $result =  $this->controller->createPassword();
        require($this->template);
    }
}
