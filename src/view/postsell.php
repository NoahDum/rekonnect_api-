<?php


class PostsellView
{
    private $controller;
    private $template;

    public function __construct(PostsellController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . 'postsell.php';
    }
    public function render()
    {
        // $result = $this->controller->insertSell();

        $result= $this->controller->insertSell();
        (require($this->template));
    }
}
