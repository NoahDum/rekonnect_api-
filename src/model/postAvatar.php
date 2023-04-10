<?php

class PostAvatarModel
{
    public $db;
    public $id;
    public $avatar;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        if (!empty($_POST) && !empty($_FILES)) {
            $this->id = trim(strip_tags($_POST["id"]));
            $this->avatar = $_FILES["avatar"];
        }
    }
}
