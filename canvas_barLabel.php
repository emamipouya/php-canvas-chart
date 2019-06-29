<?php
include 'canvas.php';

    $data['1']=30;
    $data['2']=70;
    $data['3']=75;
    $data['4']=40;
    $data['5']=90;
    $data['6']=55;
    
    
    $_canvas = new canvasMaker();
    $font='11px Arial';
    
    
    
    $label['1']="General EQ";
    $label['2']="Intera Personal";
    $label['3']="Inter personal";
    $label['4']="compatibility";
    $label['5']="stress";
    $label['6']="general tempo"; 
    
    $id='barCanvas'; 
    $width='550'; 
    $height='380';
    
    
    $startPoint2=10;
    $max1=325;
    $gap=10;
    $xgap=130;
    $wd=20;
    
    
    $config['id']=$id;
    $config['width']=$width;
    $config['height']=$height;
    $config['bgURL']=$dataURL;
    $config['font']=$font;
    $config['max1']=$max1;
    $config['gap']=$gap;
    $config['xgap']=$xgap;
    $config['wd']=$wd;


  $scr.=$_canvas->barLabels($data,$config,$label);
  
        echo "<html><body dir='rtl'> $scr </body></html>";
        
?>