<?php 

namespace MONGOAPI\apiAction;

use MongoDB\BSON\ObjectId;

class Delete extends GlobaleAction
{

    public function __construct(private string $id)
    {
        parent::__construct();
    }

    public function __toString():string
    {
        return json_encode($this->deleteArticle());
    }

    private function deleteElement(string $id)
    {
      return   $this->posts->deleteOne( ["_id"=>new ObjectId($id)]);
    }


    private function deleteArticle()
    {

        $this->findCurrentElement($this->id);

        $this->deleteElement($this->id);

       return ["message"=>"Delete ok pour l'id {$this->id} "];
       
    }
}


?>