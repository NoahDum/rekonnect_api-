<?php


class SellView
{
    private $controller;
    private $template;
    public function __construct(SellController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . "sell.php";
    }
    public function render()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $result = $this->controller->getSell();
        }

        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $result = $this->controller->deletSell();
        }

        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $result = $this->controller->modifySell();
        }
        require($this->template);
    }
}
