<?php


class LoginController
{
    private $model;
    public function __construct(LoginModel $model)
    {

        $this->model = $model;
    }
    public function connect()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $query = $this->model->db->prepare('SELECT * from rekonnect.users where name like :name');
            $query->bindParam(':name', $this->model->name);

            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if (!empty($result) && password_verify($this->model->password, $result["password"])) {

                $query = $this->model->db->prepare('SELECT rekonnect.users.id, rekonnect.users.name, rekonnect.users.email, rekonnect.users.adress, rekonnect.users.phone, rekonnect.users.adress_delivery, rekonnect.users.seller, rekonnect.users.buyer, rekonnect.users.repairer, rekonnect.users.avatar, rekonnect.users.wallet, rekonnect.users.token from rekonnect.users where name like :name');
                $query->bindParam(':name', $result["name"]);
                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);
                if (!empty($user)) {
                    $token = bin2hex(random_bytes(16)); // génère un token aléatoire
                    $query = $this->model->db->prepare('UPDATE rekonnect.users SET token = :token WHERE id = :id');
                    $query->bindParam(':token', $token);
                    $query->bindParam(':id', $user['id']);
                    $query->execute();
                }
                return $user;
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect";
                return array("error" => $error);
            }
        }
    }
}
