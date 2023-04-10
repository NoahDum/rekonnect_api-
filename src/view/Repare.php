<?php


class GetrepareView
{
    private $controller;
    private $template;
    public function __construct(GetrepareController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . "Repare.php";
    }
    public function render()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $result = $this->controller->getRepare();
        } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $result = $this->controller->deleteRepare();
        } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $result = $this->controller->modifyRepare();
        }

        require($this->template);
    }
}
