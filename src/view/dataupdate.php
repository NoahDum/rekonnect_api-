<?php


class dataUpdateView
{
    private $controller;
    private $template;

    public function __construct(dataUpdateController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . 'dataupdate.php';
    }
    public function render()
    {
        $user = $this->controller->update();
        (require($this->template));
    }
}
