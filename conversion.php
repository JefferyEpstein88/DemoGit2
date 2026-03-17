<?php
 
if(isset($_GET['Vadc']) && isset($_GET['Vcc']) && isset($_GET['Rdiv']) && isset($_GET['unit']))
{
 
 $Vadc = $_GET['Vadc'];
 $Vcc = $_GET['Vcc'];
 $Rdiv = $_GET['Rdiv'];
 $unit = $_GET['unit'];
 
 require_once("classthermistor.php");
 
 $aConverter = new Thermistor();
 
    $aConverter->setVadc($Vadc);
    $aConverter->setVcc($Vcc);
    $aConverter->setRdiv($Rdiv);
 
 $Temperature = $aConverter->calculerTemperature();
 
 echo "temperature =". round($Temperature, 2) . "°";
 
 }else{
 
 echo "ERREUR: DES PARAMETRE SONT MANQUANT " ;
 
 
 
 }
?>