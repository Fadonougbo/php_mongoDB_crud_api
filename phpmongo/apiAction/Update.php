<?php 

namespace MONGOAPI\apiAction;

use MONGOAPI\Helper;
use MongoDB\BSON\ObjectId;

class Update extends GlobaleAction
{

    private array $valideArray;

    public function __construct(private string $id)
    {
        parent::__construct();

        $this->valideArray=["name","message","tel"];
    }

    public function __toString():string
    {
        return json_encode($this->updateArticles());
    }

    private function updateElement(string $id,array $values):\MongoDB\UpdateResult
    {
      return   $this->posts->updateOne( ["_id"=>new ObjectId($id)],
                [
                    '$set'=>$values
                ]);
    }


    private function updateArticles()
    {

       $currentElement=$this->findCurrentElement($this->id);

       $body=file_get_contents("php://input");

       $decodeBody=json_decode($body,true);

       $arrayVerified=Helper::verifyArrayKeys( array_flip($decodeBody),$this->valideArray );
       
       /**
        * Renverse le tableau pour avoir la form originale
        */
       $flipArray=array_flip($arrayVerified);
       
       if(!empty($flipArray))
       {
            $this->updateElement($this->id,$flipArray);

            $result=$this->findCurrentElement($this->id);

            $arr=[];

            foreach($result as $el)
            {
                $arr[]=$el;
            }

            return $arr;
       }

       return ["message"=>"le body ne doit pas etre vide"];
       
    }
}


?>