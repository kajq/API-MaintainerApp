<?php

namespace App;
use Twilio\Rest\Client; 

class Twilio
{
    public function sendSMS($number, $code){
        require '../vendor/autoload.php';
        
        /*$sid    = "AC43ef1f157f97056a8431b1e8dd9b6470"; 
        $token  = "5e96d1fda8437ecc7df1839218c20496"; */
        $twilio = new Client(getenv('SID'), getenv('TOKEN')); 
        
        $message = $twilio->messages 
                        ->create("+506".$number, // to 
                                array( 
                                    "from" => "+15129437518",       
                                    "body" => "Código Maintainer App: ".$code
                                ) 
                        ); 
    }
}