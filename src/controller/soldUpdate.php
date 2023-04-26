<?php

class SoldController
{

    public $model;


    public function __construct(SoldModel $model)
    {
        $this->model = $model;
    }
    public function updateSold()
    {
        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
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

                    if (empty($errors)) {
                        $query =  $this->model->db->prepare("UPDATE rekonnect.users set wallet = :sold where id like :id ");
                        $query->bindParam(':id', $this->model->id);
                        $query->bindParam(':sold', $this->model->sold);
                        if ($query->execute()) {
                            return 'update ok';
                        } else {
                            return 'une erreur s\'est produite';
                        }
                    }

                    if (!empty($errors)) {
                        return $errors;
                    }
                }
            }
        }
    }
}
