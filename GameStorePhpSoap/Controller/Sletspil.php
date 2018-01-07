<?php

//twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../View');    //the path that we use to load template
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('AlleSpil.html.twig');  //refer to 'AlleSpil.html.twig so we can get template

//parameter that we take from index
$Id = $_POST['ID'];

//Client that use DeleteGame service
$wsdl = "http://wcfsoapservice.azurewebsites.net/Service1.svc?wsdl";    //service wsdl
$client = new SoapClient($wsdl);    //make soapclient using the wsdl
$parametersToSoap = array('id' => $Id); //putting the parameters in that we place into service underneath
$resultWrapped = $client->DeleteGame($parametersToSoap);    // tell the client to get the operationcontact named DeleteGame

//uses the client to GetAllGames
$resultWrapped1 = $client->GetAllGames();   //uses our soapclient to make another request which uses GetAllGames

$result = $resultWrapped1->GetAllGamesResult->Games;    //takes the result of GetOneGame

//print_r($result);

$twigContent = array("Games" => $result); // fill in the content for the page
#print_r($twigContent);
echo $template->render($twigContent);












