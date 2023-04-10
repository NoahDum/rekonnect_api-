<?php

class SellController
{
    public $model;
    public function __construct(SellModel $model)
    {
        $this->model = $model;
    }
    public function getSell()
    {


        // if (isset($_GET["id"])) {
        //     $query = $this->model->db->prepare("SELECT rekonnect.postsell.id as 'id', productName, description, price, userName, phone, pictureOne, avatar  from rekonnect.postsell inner join rekonnect.users on rekonnect.postsell.users_id = rekonnect.users.id where rekonnect.postsell.id like :id ");
        //     $query->bindParam(':id', $this->model->id);
        //     $query->execute();
        //     $result = $query->fetch(PDO::FETCH_ASSOC);
        //     return $result;
        // } else {

        //     $query = $this->model->db->query('SELECT * FROM rekonnect.postsell');
        //     $result = $query->fetchAll(PDO::FETCH_ASSOC);
        //     return $result;
        // }


        // permet de recuperer les posts de vente 



        if (isset($_GET["mysells"])) {
            $query = $this->model->db->prepare("SELECT  rekonnect.postsell.id as 'id', productName, description, price, userName, phone, pictureOne, avatar  from rekonnect.postsell inner join rekonnect.users on rekonnect.postsell.users_id = rekonnect.users.id where rekonnect.postsell.users_id like :users_id ");
            $query->bindParam(':users_id', $this->model->users);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } elseif (isset($_GET["id"])) {
            $query = $this->model->db->prepare("SELECT rekonnect.postsell.id as 'id', productName, description, price, userName, phone, pictureOne, avatar, rekonnect.postsell.users_id  from rekonnect.postsell inner join rekonnect.users on rekonnect.postsell.users_id = rekonnect.users.id where rekonnect.postsell.id like :id ");
            $query->bindParam(':id', $this->model->id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } elseif (isset($_GET["action"])) {
            $dataSearch = "%" . $this->model->search . "%";
            $search = $this->model->search ? 'and productName like :search' : "";
            $query = $this->model->db->prepare("SELECT * from rekonnect.postsell where price >= :pricemin and price <= :pricemax $search");
            $query->bindParam(':pricemin', $this->model->priceMin);
            $query->bindParam(':pricemax', $this->model->priceMax);
            $this->model->search ? $query->bindParam(':search', $dataSearch) : "";

            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            $query = $this->model->db->query('SELECT * FROM rekonnect.postsell');
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    // fonction qui permet de supprimer le  posts de vente
    public function deletSell()
    {
        if (isset($_GET["id"])) {
            $query = $this->model->db->prepare("DELETE FROM  rekonnect.postsell where id like :id");
            $query->bindParam(':id', $this->model->id);
            if ($query->execute()) {
                return "post de vente supprimé";
            } else {
                return "le post n'a pas été supprimé";
            }
        } else {
            return "une erreur vient de se produire";
        }
    }
    public function modifySell()
    {
        if (isset($_GET["id"])) {
            $query =  $this->model->db->prepare("UPDATE rekonnect.postsell set productname = :productname, description = :description, price = :price where id like :id ");
            $query->bindParam(':productname', $this->model->productName);
            $query->bindParam(':description', $this->model->description);
            $query->bindParam(':price', $this->model->price);
            $query->bindParam('id', $this->model->id);

            if ($query->execute()) {
                return 'post de vente mis a jour';
            } else {
                return 'le post de vente n\'a pas été mis à jour';
            }
        } else {
            return 'erreur';
        }
    }
}
