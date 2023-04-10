<?php



class GetrepareModel
{

    public $db;
    public $dataUser;
    public $id;
    public $repareId;
    public $users;
    public $serviceName;
    public $reparedescription;
    public $repareprice;
    public $search;
    public $priceMin;
    public $priceMax;
    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->dataUser = json_decode(file_get_contents("php://input"));
        if (isset($_GET["id"])) {
            $this->id = trim(strip_tags($_GET["id"]));
        }

        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $this->dataUser = json_decode(file_get_contents("php://input"));
            if (!empty($this->dataUser)) {

                $this->serviceName = trim(strip_tags($this->dataUser->serviceName));
                $this->repareId = trim(strip_tags($this->dataUser->repareId));
                $this->repareprice = trim(strip_tags($this->dataUser->repareprice));
                $this->reparedescription = trim(strip_tags($this->dataUser->reparedescription));
            }
        }
        if (isset($_GET["myrepare"])) {
            $this->users = trim(strip_tags($_GET["myrepare"]));
        }
        if (isset($_GET['action'])) {
            $this->search = trim(strip_tags($_GET['search']));
            $this->priceMin = trim(strip_tags($_GET['pricemin']));
            $this->priceMax = trim(strip_tags($_GET['pricemax']));
        }
    }
}
