 <?php
 require "classThermistor.php";
$Vadc = $_GET["Vadc"];
$Vcc  = $_GET["Vcc"];
$Rdiv = $_GET["Rdiv"];
$t = new Thermistor();
$t->setValues($Vadc,$Vcc,$Rdiv);
echo "Temperature: ".$t->getTemp()." C";
?>