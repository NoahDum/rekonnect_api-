<?php


class SoldView
{
    private $controller;
    private $template;

    public function __construct(SoldController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . 'soldUpdate.php';
    }
    public function render()
    {
        $user = $this->controller->updateSold();
        (require($this->template));
    }
}
