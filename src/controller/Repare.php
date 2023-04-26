<?php

class GetrepareController
{
    public $model;
    public function __construct(GetrepareModel $model)
    {
        $this->model = $model;
    }
    public function getRepare()
    {

        if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();

            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (empty($requestHeaders['Authorization'])) {
                http_response_code(401); // Non autorisé
                return ['error' => 'Token manquant'];
            } else {
                $headers = trim($requestHeaders['Authorization']);
                $token = trim(str_replace('Bearer', '', $headers));

                if (isset($_GET["myrepare"])) {
                    $query = $this->model->db->prepare("SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, avatar  from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id where rekonnect.postrepare.users_id like :users_id ");
                    $query->bindParam(':users_id', $this->model->users);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } elseif (isset($_GET["id"])) {
                    $query = $this->model->db->prepare("SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, phone, avatar  from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id where rekonnect.postrepare.id like :id ");
                    $query->bindParam(':id', $this->model->id);
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_ASSOC);
                    return $result;
                } elseif (isset($_GET["action"])) {
                    $dataSearch = "%" . $this->model->search . "%";
                    $search = $this->model->search ? 'and serviceName like :search' : "";
                    $query = $this->model->db->prepare(" SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, phone, avatar, rekonnect.postrepare.users_id from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id where price >= :pricemin and price <= :pricemax $search");
                    $query->bindParam(':pricemin', $this->model->priceMin);
                    $query->bindParam(':pricemax', $this->model->priceMax);
                    $this->model->search ? $query->bindParam(':search', $dataSearch) : "";

                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    $query = $this->model->db->query("SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, phone, avatar, rekonnect.postrepare.users_id  from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id");
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }
            }
        }

        // if (isset($_GET["myrepare"])) {
        //     $query = $this->model->db->prepare("SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, avatar  from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id where rekonnect.postrepare.users_id like :users_id ");
        //     $query->bindParam(':users_id', $this->model->users);
        //     $query->execute();
        //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
        //     return $result;
        // } elseif (isset($_GET["id"])) {
        //     $query = $this->model->db->prepare("SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, phone, avatar  from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id where rekonnect.postrepare.id like :id ");
        //     $query->bindParam(':id', $this->model->id);
        //     $query->execute();
        //     $result = $query->fetch(PDO::FETCH_ASSOC);
        //     return $result;
        // } elseif (isset($_GET["action"])) {
        //     $dataSearch = "%" . $this->model->search . "%";
        //     $search = $this->model->search ? 'and serviceName like :search' : "";
        //     $query = $this->model->db->prepare(" SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, phone, avatar, rekonnect.postrepare.users_id from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id where price >= :pricemin and price <= :pricemax $search");
        //     $query->bindParam(':pricemin', $this->model->priceMin);
        //     $query->bindParam(':pricemax', $this->model->priceMax);
        //     $this->model->search ? $query->bindParam(':search', $dataSearch) : "";

        //     $query->execute();
        //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
        //     return $result;
        // } else {
        //     $query = $this->model->db->query("SELECT rekonnect.postrepare.id as 'id', serviceName, description, price, userName, phone, avatar, rekonnect.postrepare.users_id  from rekonnect.postrepare inner join rekonnect.users on rekonnect.postrepare.users_id = rekonnect.users.id");
        //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
        //     return $result;
        // }
    }
    public function deleteRepare()
    {
        if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();

            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (empty($requestHeaders['Authorization'])) {
                http_response_code(401); // Non autorisé
                return ['error' => 'Token manquant'];
            } else {
                $headers = trim($requestHeaders['Authorization']);
                $token = trim(str_replace('Bearer', '', $headers));

                if (isset($_GET["id"])) {
                    $query = $this->model->db->prepare("DELETE from rekonnect.postrepare
            where id like :id ");
                    $query->bindParam(':id', $this->model->id);
                    if ($query->execute()) {
                        return "post de repare supprimé";
                    } else {
                        return "le post n'a pas été supprimé";
                    }
                } else {
                    return "une erreur vient de se produire";
                }
            }
        }
    }
    public function modifyRepare()
    {
        if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();

            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (empty($requestHeaders['Authorization'])) {
                http_response_code(401); // Non autorisé
                return ['error' => 'Token manquant'];
            } else {
                $headers = trim($requestHeaders['Authorization']);
                $token = trim(str_replace('Bearer', '', $headers));

                if (isset($_GET["id"])) {
                    $query = $this->model->db->prepare("UPDATE rekonnect.postrepare Set serviceName= :serviceName, description= :description, price = :price 
            where id like :id ");
                    $query->bindParam(':id', $this->model->repareId);
                    $query->bindParam(':serviceName', $this->model->serviceName);
                    $query->bindParam(':description', $this->model->reparedescription);
                    $query->bindParam(':price', $this->model->repareprice);

                    if ($query->execute()) {
                        return "post de réparation mis à jour";
                    } else {
                        return "le post de réparation n'\a pas été mis à jour";
                    }
                } else {
                    return "erreur";
                }
            }
        }
    }
}
