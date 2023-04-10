<?php

class PostAvatarController
{

    public $model;


    public function __construct(PostAvatarModel $model)
    {
        $this->model = $model;
    }

    public function newAvatar()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];

            $fileTmpPath = $this->model->avatar["tmp_name"];
            $fileName = $this->model->avatar["name"];
            $fileType = $this->model->avatar["type"];

            $fileNameArray = explode(".", $fileName);

            $fileExtension = end($fileNameArray);

            $newFileName = md5($fileName . time()) . "." . $fileExtension;

            $fileDestPath = "./img/{$newFileName}";

            // Verif avatar déjà présent, si oui on supprime le fichier avant de remplacer
            $query = $this->model->db->prepare("SELECT rekonnect.users.avatar FROM rekonnect.users WHERE id LIKE :id");
            $query->bindParam(":id", $this->model->id);

            if ($query->execute()) {
                $dataUser = $query->fetchAll(PDO::FETCH_ASSOC);
                $currentAvatar = $dataUser[0]['avatar'];
                $fileExistPath = "./img/{$currentAvatar}";

                if (file_exists($fileExistPath)) {
                    unlink($fileExistPath);
                }
            }

            $allowedTypes = array("image/jpeg", "image/png", "image/webp");
            if (in_array($fileType, $allowedTypes)) {
                move_uploaded_file($fileTmpPath, $fileDestPath);
            } else {
                $errors['type'] = "Le type de fichier est incorrect (.jpg, .png ou .webp requis)";
            }
            
            if (empty($errors)) {

                $query = $this->model->db->prepare("UPDATE rekonnect.users set avatar = :avatar where id like :id ");
                $query->bindParam(":avatar", $newFileName);
                $query->bindParam(':id', $this->model->id);
                if ($query->execute()) {
                    return $newFileName;
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
