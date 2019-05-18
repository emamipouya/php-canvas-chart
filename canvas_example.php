<?php
include 'canvas.php';

         $data['1']=30;
        $data['2']=70;
        $data['3']=75;
        $data['4']=40;
        $data['5']=90;
        $data['6']=55;
        
    $_canvas = new canvasMaker();
      $id='eqCanvas2'; $width='550'; $height='380';
     $bgURL = 'http://brainkava.ir/images/eq1.png';
     $font='17px Arial';
     

$startPoint2=13;
$max1=235;
$scale=ceil($max1/130);
$gap=10;
$xgap=70;
  $wd=27;
  
   $scr =$_canvas->graphColumn($id,$width,$height,$data,$bgURL,$font,$startPoint2,$max1,$gap,$xgap,$wd,$scale);

echo "<html><body> $scr </body></html>";
?>