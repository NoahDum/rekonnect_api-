<?php

class PostsellController
{

    public $model;


    public function __construct(PostsellModel $model)
    {
        $this->model = $model;
    }

    public function insertSell()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (function_exists('apache_request_headers')) {
                $requestHeaders = apache_request_headers();

                $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
                if (empty($requestHeaders['Authorization'])) {
                    http_response_code(401); // Non autorisé
                    return ['error' => 'Token manquant'];
                } else {
                    $headers = trim($requestHeaders['Authorization']);
                    $token = trim(str_replace('Bearer', '', $headers));

                    $errors = [];
                    if (empty($this->model->productName)) {
                        $error = "Le nom du produit est obligatoire";
                        $errors["productName"] = "Le nom du produit est obligatoire";
                    }
                    if (empty($this->model->description)) {
                        $error = "Veuillez ajouter une description du produit";
                        $errors["description"] = "Veuillez ajouter une description du produit";
                    }
                    if (empty($this->model->price)) {
                        $error = "Veuillez ajouter un prix au produit";
                        $errors["price"] = "Veuillez ajouter un prix au produit";
                    }
                    if ($this->model->price < 0) {
                        $error = "Le prix ne peut pas etre inférieur à 0€";
                        $errors["price"] = "Le prix ne peut pas etre inférieur à 0€";
                    }

                    $fileTmpPath = $this->model->inputPictureOne["tmp_name"];
                    $fileName = $this->model->inputPictureOne["name"];
                    $fileType = $this->model->inputPictureOne["type"];

                    $fileNameArray = explode(".", $fileName);

                    $fileExtension = end($fileNameArray);

                    $newFileName = md5($fileName . time()) . "." . $fileExtension;

                    $fileDestPath = "./img/{$newFileName}";


                    $allowedTypes = array("image/jpeg", "image/png", "image/webp");
                    if (in_array($fileType, $allowedTypes)) {

                        move_uploaded_file($fileTmpPath, $fileDestPath);
                    } else {

                        $error = "Le type de fichier est incorrect (.jpg, .png ou .webp requis)";
                    }

                    if (empty($errors)) {

                        $query = $this->model->db->prepare('INSERT INTO rekonnect.postsell (productName, description, price, pictureOne, userName, users_id) VALUES (:productName, :description, :price, :pictureOne, :userName, :users_id)');
                        $query->bindParam(':productName', $this->model->productName);
                        $query->bindParam(':description', $this->model->description);
                        $query->bindParam(':userName', $this->model->userName);
                        $query->bindParam(":pictureOne", $newFileName);
                        $query->bindParam(':users_id', $this->model->users_id);
                        $query->bindParam(':price', $this->model->price, PDO::PARAM_INT);
                        if ($query->execute()) {
                            return 'votre annonce a bien été enregistrée';
                        } else {
                            return "echec";
                        }
                        return "insert ok";
                    } else {
                        return $errors;
                    }
                }
            }
        }

        // if($_SERVER["REQUEST_METHOD"] == "PUT"){

        // }
    }
    public function deleteSell()
    {
        $query =  $this->model->db->query("DELETE FROM rekonnect.postsell where id like :id");
        $query->bindParam(':id', $id);
    }
}
