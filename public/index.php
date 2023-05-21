<?php
require "../vendor/autoload.php";
use GuzzleHttp\Psr7\Response;
use function Http\Response\send;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router=new AltoRouter();

$router->map("GET","/v1/articles",[],"read_articles");
$router->map("POST","/v1/post/article",[],"create_article");
$router->map("PUT","/v1/update/article/[*:id]",[],"update_article");
$router->map("DELETE","/v1/delete/article/[*:id]",[],"delete_article");

$match=$router->match();


if($match)
{
    require dirname(__DIR__).DIRECTORY_SEPARATOR."phpmongo".DIRECTORY_SEPARATOR."apiAction/crud.php";
}else 
{
    $body=json_encode(["message"=>"Bad HTTP method or url"]);
    $response=new Response(404,["Content-Type","application/json"],$body);

    send($response);
}


?>