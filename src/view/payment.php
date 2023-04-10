<?php


class PaymentView
{
    private $controller;
    private $template;

    public function __construct(PaymentController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . 'payment.php';
    }
    public function render()
    {
        $result= $this->controller->getWallet();
        (require($this->template));
    }
}