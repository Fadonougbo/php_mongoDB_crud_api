<?php
namespace MONGOAPI\apiAction;

use MONGOAPI\Helper;

class Create extends GlobaleAction
{
    private array $valideArray;

    public function __construct()
    {
        parent::__construct();

        $this->valideArray=["name","message","tel"];
    }

    public function __toString():string
    {
        return json_encode($this->createArticles());
    }


    private function createArticles()
    {
       $body=file_get_contents("php://input");

       $decodeBody=json_decode($body,true);

       $arrayVerified=Helper::verifyArrayKeys( array_flip($decodeBody),$this->valideArray );
       
       /**
        * Renverse le tableau pour avoir la form originale
        */
       $flipArray=array_flip($arrayVerified);
       
       if(!empty($flipArray))
       {
            ($this->posts)->insertMany([$flipArray]);

            return $flipArray;
       }

       return ["message"=>"le body ne doit pas etre vide"];
       
    }
}


?>