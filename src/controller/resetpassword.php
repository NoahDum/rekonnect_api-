<?php

use PHPMailer\PHPMailer\PHPMailer;

require('../vendor/autoload.php');


class ResetPasswordController
{
    public $model;

    public function __construct(ResetPasswordModel $model)
    {
        $this->model = $model;
    }
    public function forgotPassword()
    {


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $query = $this->model->db->prepare('SELECT rekonnect.users.email from rekonnect.users where email like :email');
            $query->bindParam(':email', $this->model->email);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (!empty($data)) {
                $token = bin2hex(random_bytes(50));
                $query = $this->model->db->prepare("INSERT INTO rekonnect.password_reset (email, token) VALUE (:email, :token)");
                $query->bindParam(":email", $this->model->email);
                $query->bindParam(":token", $token);
                if ($query->execute()) {
                    $phpmailer = new PHPMailer();
                    $phpmailer->isSMTP();
                    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
                    $phpmailer->SMTPAuth = true;
                    $phpmailer->Port = 2525;
                    $phpmailer->Username = '5fe0b589c39684';
                    $phpmailer->Password = '9463eb000c8f98';

                    $phpmailer->From = "authentication@rekonnect.com";
                    $phpmailer->FromName = "Service authentification";

                    $phpmailer->addAddress($this->model->email);
                    $phpmailer->isHTML();
                    $phpmailer->CharSet = "UTF-8";
                    $phpmailer->Subject = "Rekonnect : Réinitialisation de votre mot de passe";

                    // Ajout du logo comme signature du mail de reset
                    $signature_path = "./img/noaccess/logo_complete.png";
                    $signature_name = "logo_complete.png";
                    $signature_cid = "logo_signature";
                    $signature_type = "image/png";
                    $phpmailer->addEmbeddedImage($signature_path, $signature_cid, $signature_name, 'base64', $signature_type);

                    // Ajout de l'icone entourant le lien de reset
                    $icon_path = "./img/noaccess/icon_lock.png";
                    $icon_name = "icon_lock.png";
                    $icon_cid = "icon_link";
                    $icon_type = "image/png";
                    $phpmailer->addEmbeddedImage($icon_path, $icon_cid, $icon_name, 'base64', $icon_type);

                    $phpmailer->Body = "<p>Vous avez fait une demande afin de réinitialiser votre mot de passe.</p>";
                    $phpmailer->Body .= "<p>Veuillez cliquer sur le lien suivant et suivre les instructions. <img src='cid:" . $icon_cid . "' width='10px'> <a href='http://localhost:3000/newpassword/?token={$token}'>Rénitialisation du mot de passe</a> <img src='cid:" . $icon_cid . "' width='10px'></p>";
                    $phpmailer->Body .= "<p>Si vous n'êtes pas à l'origine de cette demande merci d'ignorer et de supprimer ce mail.</p>";
                    $phpmailer->Body .= "<p>Pour toute autre demande n'hésitez pas à contacter notre service clientèle à : <a href='mailto:contact@rekonnect.com'>contact@rekonnect.com</a></p>";
                    $phpmailer->Body .= "<p>Merci de votre confiance et à bientôt sur notre site !</p>";
                    $phpmailer->Body .= "<p>L'équipe ReKonnect.</p>";
                    $phpmailer->Body .= '<p><img src="cid:' . $signature_cid . '" alt="Logo de l\'entreprise" width="200px"></p>';

                    $phpmailer->send();

                    $success = "Votre lien de réinitialisation a été envoyé sur votre adresse email. Redirection vers la page d'accueil...";
                    return array("success" => $success);
                } else {
                    $errorRequest = "Une erreur s'est produite, veuillez réessayer dans quelques instants.";
                    return array("errorRequest" => $errorRequest);
                }
            } else {
                $notFound = "Adresse email inexistante.";
                return array("notFound" => $notFound);
            }
        }
    }
}
