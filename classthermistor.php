 <?php
class Thermistor {
 
    private $Vcc = 5;
    private $Rdiv = 10;
    private $Vadc = 2.5;
 
    private $table = [
        [111.3,-30],[86.39,-25],[67.74,-20],[53.39,-15],[42.45,-10],
        [33.89,-5],[27.28,0],[22.05,5],[17.96,10],[14.68,15],
        [12.09,20],[10,25],[8.313,30],[6.941,35],[5.828,40],
        [4.912,45],[4.161,50],[3.537,55],[3.021,60],[2.589,65],
        [2.229,70],[1.924,75],[1.669,80],[1.451,85],[1.266,90],
        [1.108,95],[0.9735,100],[0.8574,105],[0.7579,110]
    ];
 
    function setValues($Vadc,$Vcc,$Rdiv){
        $this->Vadc=$Vadc;
        $this->Vcc=$Vcc;
        $this->Rdiv=$Rdiv;
    }
 
    function getTemp(){
 
        $Rt = ($this->Vadc*$this->Rdiv)/($this->Vcc-$this->Vadc);
 
        for($i=0;$i<count($this->table)-1;$i++){
 
            $Rt1=$this->table[$i][0];
            $T1=$this->table[$i][1];
 
            $Rt2=$this->table[$i+1][0];
            $T2=$this->table[$i+1][1];
 
            if($Rt <= $Rt1 && $Rt >= $Rt2){
 
                $M = ($T2-$T1)/($Rt2-$Rt1);
                $B = $T1 - $M*$Rt1;
 
                return $M*$Rt + $B;
            }
        }
    }
}
 