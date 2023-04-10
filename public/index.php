<?php

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");




$page = "users";
if (isset($_GET['page'])) {
    $page = $_GET["page"];
}


$pages = array(


    "users" => array(
        "model" => "UsersModel",
        "view" => "UsersView",
        "controller" => "UsersController"
    ),
    "login" => array(
        "model" => "LoginModel",
        "view" => "LoginView",
        "controller" => "LoginController"
    ),
    "dataupdate" => array(
        "model" => "dataUpdateModel",
        "view" => "dataUpdateView",
        "controller" => "dataUpdateController"
    ),
    "resetpassword" => array(
        "model" => "ResetPasswordModel",
        "view" => "ResetPasswordView",
        "controller" => "ResetPasswordController"
    ),
    "newpassword" => array(
        "model" => "NewPasswordModel",
        "view" => "NewPasswordView",
        "controller" => "NewPasswordController"
    ),
    "postsell" => array(
        "model" => "PostsellModel",
        "view" => "PostsellView",
        "controller" => "PostsellController"
    ),
    "postrepare" => array(
        "model" => "PostrepareModel",
        "view" => "PostrepareView",
        "controller" => "PostrepareController"
    ),
    "postAvatar" => array(
        "model" => "PostAvatarModel",
        "view" => "PostAvatarView",
        "controller" => "PostAvatarController"
    ),
    "sell" => array(
        "model" => "SellModel",
        "view" => "SellView",
        "controller" => "SellController"
    ),
    "Repare" => array(
        "model" => "GetrepareModel",
        "view" => "GetrepareView",
        "controller" => "GetrepareController"
    ),
    "soldUpdate" => array(
        "model" => "SoldModel",
        "view" => "SoldView",
        "controller" => "SoldController"
    ),
    "payment" => array(
        "model" => "PaymentModel",
        "view" => "PaymentView",
        "controller" => "PaymentController"
    )

);

$find = false;
foreach ($pages as $key => $value) {
    if ($page === $key) {

        $model = $value["model"];
        $view = $value["view"];
        $controller = $value["controller"];

        $find = true;
    }
}

require("../config/index.php");
$dsn = "mysql:host" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);


if ($find) {
    require(DIR_MODEL . $page . ".php");
    require(DIR_CONTROLLER . $page . ".php");
    require(DIR_VIEW . $page . ".php");

    $pageModel = new $model($db);
    $pageController = new $controller($pageModel);
    $pageView = new $view($pageController);

    $pageView->render();
}
