<?php

//twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../View');    //the path that we use to load template
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('AlleSpil.html.twig');  //refer to 'AlleSpil.html.twig so we can get template

//Client that use GetAllGames service
$wsdl = "http://wcfsoapservice.azurewebsites.net/Service1.svc?wsdl";    //service wsdl
$client = new SoapClient($wsdl);    //make soapclient using the wsdl
$resultWrapped = $client->GetAllGames();    // tell the client to get the operationcontact named GetAllGames

//print_r($resultWrapped);

$result = $resultWrapped->GetAllGamesResult->Games; //Takes the Games from the result

//print_r($result);


$twigContent = array("Games" => $result); // fill in the content for the page
#print_r($twigContent);
echo $template->render($twigContent);












