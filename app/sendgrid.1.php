<?php
$mail = "kajimenezq@est.utn.ac.cr";
$name = "Keilor";
$token = "123";
        require '../vendor/autoload.php';
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("noreply@maintainerapp.com", "Maintainer App");
        $email->setSubject("Código de Verificación");
        $email->addTo($mail, $name);
        //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", "<strong>Ingresa al siguiente Link para activar tu cuenta en Maintainer App</strong>
            <br> <h3> http://127.0.0.1:8000/clic?upn=$token </h3>"
        );
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
            $res = $response->statusCode();
            return $res;
        } catch (Exception $e) {
            return 'Caught exception: '. $e->getMessage() ."\n";
        }
