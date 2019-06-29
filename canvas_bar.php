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
     $font='10px Arial';
     

$startPoint2=13;
$max1=235;
$scale=ceil($max1/130);
$gap=10;
$xgap=70;
  $wd=27;
  
   $scr =$_canvas->graphColumn($id,$width,$height,$data,$bgURL,$font,$startPoint2,$max1,$gap,$xgap,$wd,$scale);




  $val=$data['1'];
        $id2='eqCanvas';
        $r=100;
        $lowestBest=1;
        $title="General EQ";
        $scr .=  $_canvas->graphGauge($id2,$width,$height,$font,$val,$r,$lowestBest,$title);
        
        

               $label['1']="General EQ";
        $label['2']="Intera Personal";
        $label['3']="Inter personal";
        $label['4']="compatibility";
        $label['5']="stress";
        $label['6']="general tempo"; 
        
                $id='barCanvas'; 
        $width='550'; 
        $height='380';
        
       // $dataURL = 'http://brainkava.ir/images/qimages/meslesh.png';
        $font='18px B zar';
        
        
        $startPoint2=10;
        $max1=325;
       // $scale=ceil($max1/200);
        $gap=10;
        $xgap=130;
        $wd=20;
  
  
    $config['id']=$id;
    $config['width']=$width;
    $config['height']=$height;
    $config['bgURL']=$dataURL;
    $config['font']=$font;
    //$config['startPoint2']=$startPoint2;
   $config['max1']=$max1;
   // $config['scale']=$scale;
    $config['gap']=$gap;
    $config['xgap']=$xgap;
    $config['wd']=$wd;
      

  $scr.=$_canvas->barLabels($data,$config,$label);
  
        echo "<html><body dir='rtl'> $scr </body></html>";
        
?>