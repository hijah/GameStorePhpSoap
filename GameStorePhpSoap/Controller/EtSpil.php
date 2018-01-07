<?php

//twig
require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../View');    //the path that we use to load template
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('EtSpil.html.twig');    //refer to 'EtSpil.html.twig so we can get template

//parameter that we take from index
$Id = $_POST['ID'];

//Client that use GetOneGame service
$wsdl = "http://wcfsoapservice.azurewebsites.net/Service1.svc?wsdl";    //service wsdl
$client = new SoapClient($wsdl);    //make soapclient using the wsdl
$parametersToSoap = array('id' => $Id); //putting the parameters in that we place into service underneath
$resultWrapped = $client->GetOneGame($parametersToSoap);    // tell the client to get the operationcontact named GetOneGame

//print_r($resultWrapped);

$result = $resultWrapped->GetOneGameResult; //takes the result of GetOneGame

//print_r($result);

$twigContent = array("Game" => $result); // fill in the content for the page
#print_r($twigContent);
echo $template->render($twigContent);













