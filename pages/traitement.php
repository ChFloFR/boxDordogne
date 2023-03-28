<?php
require_once __DIR__ . '/vendor/autoload.php';
use \ReCaptcha\ReCaptcha;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //récupération des champs
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //nettoyage des données
    $nom = htmlspecialchars(strip_tags(trim($nom)), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags(trim($message)), ENT_QUOTES, 'UTF-8');

        //validation des champs
    if(empty($nom) || empty($email) || empty($message)){
        echo "Tous les champs sont requis";
        exit;
    }

    //vérification de l'email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Adresse email invalide";
        exit;
    }

    //captcha
    require_once('recaptchalib.php');
    $secret = "SECRET_KEY";
    $response = null;
    $reCaptcha = new ReCaptcha($secret);
    //vérification réponse
    if($_POST["g-recaptcha-response"]){
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }
    //réponse échoue
    if (!$response || !$response->success){
        echo "Vérification échouée";
        exit;
    }
    //Envoi de l'email
    $toMail = "testdevflo@gmail.fr";
    $subject = "Nouveau message - formulaire contact Box";
    $body = "Nom: $nom\nEmail : $email\nMessage:\n$message";
    $headers = "From: $email" . "\r\n" .
                "Reply-To: $email" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();

    if(mail($toMail, $subject, $body)){
        echo "Message envoyé";
    }else{
        echo "Une erreur est survenue, le message n'a pas été envoyé";
    }
}
?>