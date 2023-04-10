<?php


class PostAvatarView
{
    private $controller;
    private $template;

    public function __construct(PostAvatarController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES . 'postAvatar.php';
    }
    public function render()
    {
        $result= $this->controller->newAvatar();
        (require($this->template));
    }
}
