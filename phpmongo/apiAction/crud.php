<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use MONGOAPI\apiAction\Create;
use MONGOAPI\apiAction\Delete;
use MONGOAPI\apiAction\Read;
use MONGOAPI\apiAction\Update;

use function Http\Response\send;

try 
{

    $server=ServerRequest::fromGlobals();

    $body="";
    $code=200;
    $id=$match["params"]["id"]??1;

    if($server->getMethod()==="GET")
    {
        $body=new Read();

    }else if($server->getMethod()==="POST")
    {
        $body=new Create();

    }else if($server->getMethod()==="PUT")
    {
        $body=new Update($id);
    }else if($server->getMethod()==="DELETE")
    {
        $body=new Delete($id);
    }else 
    {
        $body=json_encode(["message"=>"Method not allowed"]);
        $code=405;
    }

    $response=new Response($code,["Content-Type"=>"application/json"],$body);
    send($response);

}catch(Exception $error)
{
    $body=json_encode(["message"=>$error->getMessage()]);
    $response=new Response(200,["Content-Type"=>"application/json"],$body);
    send($response);
}



?>