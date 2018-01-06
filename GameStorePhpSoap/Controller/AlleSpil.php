<?php

//twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../View');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('AlleSpil.html.twig');

$wsdl = "http://wcfsoapservice.azurewebsites.net/Service1.svc?wsdl";
$client = new SoapClient($wsdl);
$resultWrapped = $client->GetAllGames();

//print_r($resultWrapped);

$result = $resultWrapped->GetAllGamesResult->Games;

//print_r($result);


$twigContent = array("Games" => $result); // fill in the content for the page
#print_r($twigContent);
echo $template->render($twigContent);












