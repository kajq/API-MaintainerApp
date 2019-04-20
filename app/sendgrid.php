<?php

namespace App;

class sendgrid
{
    public function sendmail($mail, $name, $token){
        require '../vendor/autoload.php';
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("noreply@maintainerapp.com", "Maintainer App");
        $email->setSubject("Código de Verificación");
        $email->addTo($mail, $name);
        //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $uri = "http://127.0.0.1:8000/clic?upn=$token";
        $email->addContent(
            "text/html", "<strong>Ingresa al siguiente Link para activar tu cuenta en Maintainer App</strong>
            <br> <a href='$uri'>Activar cuenta</a>"
        );
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            echo "APi key: " . getenv('SENDGRID_API_KEY');
            $res = $response->statusCode();
            return $res;
        } catch (Exception $e) {
            return 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
}