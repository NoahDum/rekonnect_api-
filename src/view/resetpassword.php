<?php


class ResetPasswordView
{
    private $controller;
    private $template;
    public function __construct(ResetPasswordController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . 'resetpassword.php';
    }
    public function render()
    {
        $result = $this->controller->forgotPassword();
        require($this->template);
    }
}
