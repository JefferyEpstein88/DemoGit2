 <?php
class Thermistor {
 
    protected $Vcc  ;
    protected $Rdiv ;
    protected $Vadc ;
    protected $temp ;
    protected $Rt ;
 
private $tblConvert = array( array(111.3, -30.0), array(86.39, -25),
array( 67.74, -20 ), array( 53.39, -15 ), array( 42.45, -10 ),
array( 33.89, -5 ), array( 27.28, 0 ), array( 22.05, 5 ),
array( 17.96, 10 ), array( 14.68, 15 ), array( 12.09, 20 ),
array( 10, 25 ), array( 8.313, 30 ), array( 6.941, 35 ),
array( 5.828, 40 ),array( 4.912, 45 ), array( 4.161, 50 ),
array( 3.537, 55 ), array( 3.021, 60 ), array( 2.589, 65 ),
array( 2.229, 70 ), array( 1.924, 75 ), array( 1.669, 80 ),
array( 1.451, 85 ), array( 1.266, 90 ), array( 1.108, 95 ),
array( 0.9735, 100 ), array( 0.8574, 105 ), array( 0.7579, 110 ) );

public function __construct($Vcc = 5.0, $Rdiv= 10.0, $Vadc= 2.5) 
{
$this->Vcc = $Vcc;
$this->Rdiv = $Rdiv;
$this->Vadc = $Vadc;
$this->Rt = 0;
$this-> temp = 0;
}
 

//setters
public function setVcc($Vcc)
{
$this ->Vcc=$Vcc;
}
public function setRdiv($Rdiv)
{
$this ->Rdiv=$Rdiv;
}
public function setVadc($Vadc)
{
$this ->Vadc=$Vadc;
}

//getters
public function getVcc()
{
return $this->$Vcc;
}
public function getRdiv()
{
return $this->$Rdiv;
}
public function getVadc()
{
return $this->$Vadc;
}
public function getRt()
{
return $this->$Rt;
}
public function gettemp()
{
return $this->$temp;
}

   // calcul de la résistance du thermistor
    public function calculerRt()
    {
        if ($this->Vcc == $this->Vadc) {
            return false; // false car il empeche un divisions par 0
        }
 
        $this->Rt = ($this->Vadc * $this->Rdiv) / ($this->Vcc - $this->Vadc);
        return $this->Rt;
    }
 
    // calcul de la température
    public function calculerTemperature()
    {
        // calculer Rt
        $this->calculerRt();
 
        $i = 0;
        $taille = count($this->tblConvert);
 
        while ($i < $taille - 1)
        {
            $rt1 = $this->tblConvert[$i][0];
            $t1  = $this->tblConvert[$i][1];
 
            $rt2 = $this->tblConvert[$i + 1][0];
            $t2  = $this->tblConvert[$i + 1][1];
 
            if ($this->Rt <= $rt1 && $this->Rt >= $rt2)
            {
                $m = ($t2 - $t1) / ($rt2 - $rt1);
                $b = $t1 - ($m * $rt1);
 
                $this->Temperature = ($m * $this->Rt) + $b;
 
                return $this->Temperature;
            }
 
            $i++;
        }
 
        return false;
    }
 
}
 
?>