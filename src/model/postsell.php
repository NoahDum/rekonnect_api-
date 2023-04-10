<?php

class PostsellModel
{
    public $db;
    public $dataUser;
    public $productName;
    public $description;
    public $price;
    public $userName;
    public $users_id;
    public $inputPictureOne;
    public $id;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        // $this->dataUser = json_decode(file_get_contents("php://input"));
        if (!empty($_POST)) {
            $this->productName = trim(strip_tags($_POST["productName"]));
            $this->description = trim(strip_tags($_POST["description"]));
            $this->price = trim(strip_tags($_POST["price"]));
            $this->userName = trim(strip_tags($_POST["userName"]));
            $this->users_id = trim(strip_tags($_POST["users_id"]));
            $this->inputPictureOne = $_FILES["inputPictureOne"];
        }
        // if (!empty($_FILES)) {
        //         $this->image = $_FILES["image"];
        //     }


    }
}
