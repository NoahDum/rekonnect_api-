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

        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $query = $this->model->db->prepare('SELECT * from rekonnect.users where name like :name');
            $query->bindParam(':name', $this->model->name);

            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if (!empty($result) && password_verify($this->model->password, $result["password"])) {

                $query = $this->model->db->prepare('SELECT rekonnect.users.id, rekonnect.users.name, rekonnect.users.email, rekonnect.users.adress, rekonnect.users.phone, rekonnect.users.adress_delivery, rekonnect.users.seller, rekonnect.users.buyer, rekonnect.users.repairer, rekonnect.users.avatar, rekonnect.users.wallet from rekonnect.users where name like :name');
                $query->bindParam(':name', $result["name"]);

                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);

                return $user;
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect";
                return array("error" => $error);
            }
        }






        // if (!empty($_POST)) {
        //     $email = trim(strip_tags($_POST["email"]));
        //     $password = trim(strip_tags($_POST["password"]));
        // }

        // $query = $this->model->db->prepare("SELECT * FROM  telefoot_auth.users where email like :email");
        // $query->bindParam('email', $email);
        // $query->execute();
        // $result = $query->fetch(PDO::FETCH_ASSOC);


        // if (!empty($result) && password_verify($password, $result["password"])) {
        //     $_SESSION["user"] = [
        //         "id" => $result["id"],
        //         "email" => $result["email"],
        //         "ip" => $_SERVER["REMOTE_ADDR"]
        //     ];

        //     header("Location: ./?page=myCompte");
        // } else {
        //     var_dump('false');
        // }
    }
}
