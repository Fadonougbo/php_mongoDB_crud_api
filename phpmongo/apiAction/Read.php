<?php
namespace MONGOAPI\apiAction;

class Read extends GlobaleAction
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __toString():string
    {
        return json_encode($this->getArticles());
    }

    private function getArticles():array
    {
        $articleList=[];
        $articles=$this->posts->find();

        foreach($articles as $article)
        {
            $articleList[]=$article;
        }

        return $articleList;
    }
}


?>