<?php


class NewPasswordController
{
    public $model;
    public function __construct(NewPasswordModel $model)
    {
        $this->model = $model;
    }
    public function createPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];
            if (!empty($this->model->token)) {
                $query = $this->model->db->prepare("SELECT rekonnect.password_reset.email from rekonnect.password_reset where token like :token");
                $query->bindParam(':token', $this->model->token);
                $query->execute();
                $data = $query->fetch(PDO::FETCH_ASSOC);

                if (!empty($data)) {

                    $email = $data["email"];


                    $uppercase = preg_match("/[A-Z]/", $this->model->password);
                    $lowercase = preg_match("/[a-z]/", $this->model->password);
                    $number = preg_match("/[0-9]/", $this->model->password);

                    if (!$uppercase || !$lowercase || !$number || strlen($this->model->password < 8)) {
                        $errors["password"] = "le mot de passe doit contenir une lettre minuscule, une lettre majuscule un chiffre et minimum 8 caractères";
                    }

                    if ($this->model->password !== $this->model->passwordConfirm) {
                        $errors["password"] = "les mots de passe ne sont pas identiques.";
                    }

                    if (!$errors) {
                        $hash = password_hash($this->model->password, PASSWORD_DEFAULT);
                        $query = $this->model->db->prepare('UPDATE rekonnect.users set password = :password where email like :email');
                        $query->bindParam(':password', $hash);
                        $query->bindParam(':email', $email);
                        if ($query->execute()) {
                            $result = "success";

                            return $result;
                        } else {

                            return $result = $errors;
                        }
                    } else {
                        return $result = $errors;
                    }
                }
            } else {

                return $result = 'echec';
            }
        }
    }
}
