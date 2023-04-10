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
