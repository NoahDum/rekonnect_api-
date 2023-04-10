<?php



class SellModel
{

    public $db;
    public $id;
    public $users;
    public $dataUser;
    public $description;
    public $productName;
    public $price;
    public $search;
    public $priceMin;
    public $priceMax;
    public function __construct(PDO $db)
    {
        $this->db = $db;

        if (isset($_GET["id"])) {
            $this->id = trim(strip_tags($_GET["id"]));
        }
        if (isset($_GET["mysells"])) {
            $this->users = trim(strip_tags($_GET["mysells"]));
        }
        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $this->dataUser = json_decode(file_get_contents("php://input"));
            if (!empty($this->dataUser)) {
                $this->productName = $this->dataUser->productName;
                $this->description = $this->dataUser->description;
                $this->price = $this->dataUser->price;
            }
        }
        if (isset($_GET['action'])) {
            $this->search = trim(strip_tags($_GET['search']));
            $this->priceMin = trim(strip_tags($_GET['pricemin']));
            $this->priceMax = trim(strip_tags($_GET['pricemax']));
        }
    }
}
