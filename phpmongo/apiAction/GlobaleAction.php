<?php
namespace MONGOAPI\apiAction;

use Exception;
use MongoDB\BSON\ObjectId;
use MongoDB\Client;
use MongoDB\Collection;

abstract class GlobaleAction
{
    protected Collection $posts;
    
    public function __construct()
    {
         $this->posts=(new Client())->selectDatabase($_ENV["DB_NAME"])->selectCollection($_ENV["COLLECTION"]);
    }


    /**
     * Verifie si l'element exist;
     *
     * @param string $id
     * @return array
     */
    protected function findCurrentElement(string $id):array
    {
        try 
        {
            $arr=[];
        
            $element=$this->posts->find(["_id"=>new ObjectId($id) ]);

            foreach($element as $el)
            {
                $arr[]=$el;
            }

            return $arr;

        }catch(Exception $e)
        {
           return ["message"=>"Id incorrecte"];
        }
    }
}


?>