<?php
include 'canvas.php';
    $_canvas = new canvasMaker();
    
    $data['1']=30;
    
    $width='550'; $height='380';
    $font='10px Arial';
    $val=$data['1'];
    $id2='eqCanvas';
    $r=100;
    $lowestBest=1;
    $title="General EQ";
    $scr =  $_canvas->graphGauge($id2,$width,$height,$font,$val,$r,$lowestBest,$title);
    
        echo "<html><body dir='rtl'> $scr </body></html>";
        
?>