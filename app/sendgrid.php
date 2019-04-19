<?php
require '../vendor/autoload.php';
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("noreply@maintainerapp.com", "Maintainer App");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("keilorjimenez95@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}