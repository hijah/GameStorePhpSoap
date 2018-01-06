<?php

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../View');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('AlleSpil.html.twig');

$Id = $_POST['ID'];
$Title = $_POST['Title'];
$Price = $_POST['Price'];
$AntalPåLager = $_POST['AntalPåLager'];

$wsdl = "http://wcfsoapservice.azurewebsites.net/Service1.svc?wsdl";
$client = new SoapClient($wsdl);
$parametersToSoap = array('id' => $Id, 'title' => $Title, 'price' => $Price, 'antalPåLager' => $AntalPåLager);
$resultWrapped = $client->AddGame($parametersToSoap);


$resultWrapped1 = $client->GetAllGames();

$result = $resultWrapped1->GetAllGamesResult->Games;

//print_r($result);

$twigContent = array("Games" => $result); // fill in the content for the page
#print_r($twigContent);
echo $template->render($twigContent);






