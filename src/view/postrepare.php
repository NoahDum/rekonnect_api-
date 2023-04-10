<?php
class PostrepareView
{
    private $controller;
    private $template;
    public function __construct(PostrepareController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . 'postrepare.php';
    }
    public function render()
    {
        $result= $this->controller->insertRepare();
        (require($this->template));
    }
}