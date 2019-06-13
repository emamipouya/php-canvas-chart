<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_neo
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
 
/**
 * canvas Model
 *
 * @since  0.0.1
 */
class canvasMaker {
    
public $color;//['1']="blue";

public function canvasMaker(){
    
    $this->color['0']='#77FFAA';
    $this->color['1']='#AA00AA';
    $this->color['2']='#00AAAA';
    $this->color['3']='#AAAA00';
    $this->color['4']='#AAAAAA';
}
  function create($id,$width,$height){
            $scr="<p>";
     $scr.="<canvas id='$id' width='$width' height='$height' style='border:2px solid #000000;'> HTML5 canvas tag is unsupported in your browse</canvas>";
     return  $scr;
  }
  /////////////////////////////////
  function   getCanvas($id){
     $scr="<script>";
      $scr.=" var eqt = document.getElementById('$id');";
  $scr.="var $id = eqt.getContext('2d');";
   return  $scr;
  }
  
  /////////////////////////////////////
  //// Draw Column Graph 
  /////////////////////////////
  function graphColumn($id,$width,$height,$data,$bgURL,$font,$startPoint2,$max1,$gap,$xgap,$wd,$scale){
  $res=$this->create($id,$width,$height);
  $res.=$this->getCanvas($id);
  $res.=$this->setBackground($id,$bgURL);
  $res.=$this->setFont($id,$font);
    $res.=$this->onload($id,$bgURL);
//$scale=ceil($max1/130);

  
$i=1;
foreach($data as $var){

  $l_variable=$var*$scale;
  $y_variable=$max1-$l_variable;
    $startP=$startPoint2+$i*$xgap;
    $j=$i%5;
  $color=$this->color[$j];
  $res.=$this->rect($id, $startP,$gap,$var,$y_variable,$wd,$l_variable,$color);
  $i++;
}
     $res.=$this->endScript();
  return $res;
  }
  /*
*   Draw Gauge Graph 
*/
  function graphGauge($id,$width,$height,$font,$n,$r,$lowestBest,$title){
      $border=0;
        $res=$this->create($id,$width,$height,$border);
        $res.=$this->getCanvas($id);
    $res.=$this->setFont($id,$font);
    $res.=$this->initiateGauge($id,$r,$n,$lowestBest,$title,$font);
    $res.=$this->endScript();
     return $res;
    
  }

/**
 * Initialize Gauge
 * 
 */
  
  function initiateGauge($id,$r,$n,$lowestBest,$title,$font){
      $func=$id.'_action';
        $scr="var teta=0.0;
            var stop=false;
            var n=$n;
            var count=0;
            var xc=170;
            var yc=200;
            var r=$r;
            var r1=r+20;
            var r2=r+40;
            var r3=r+27;
            var lowbeter=$lowestBest;";
            
    $scr="document.addEventListener('DOMContentLoaded', $func);
    function $func(){
    $scr;
    $id.fillStyle = '#000';";
     $scr.="   $id.beginPath();";
     $scr.="   $id.arc(xc,yc,r2+30,0.1,Math.PI-0.1,true);";
    $scr.="    $id.closePath();";
    $scr.="    $id.fill();
        
            $id.fillStyle = '#AAF';
        a=0.0;
        for(i=0;i<=10;i++)
        {
            j=i*10;
            x=xc-r2*Math.cos(a);
            y=yc-r2*Math.sin(a);
            $id.fillText(j, x+10, y); 
            a+=0.308;
        }
         $id.fillStyle = '#333';
        $id.fillText('$title', xc+r2, yc+40); 
        $id.fillStyle = '#eee';
        $id.beginPath();
        $id.arc(xc,yc,r1+1,0.1,Math.PI-0.1,true);
        $id.closePath();
        $id.fill();


        //var grd=$id.createRadialGradient(xc-r1,yc,r1,xc+r1,yc,r1);
        var grd=$id.createLinearGradient(xc-r1,yc,xc+r1,yc);
        if(lowbeter===1){
        grd.addColorStop(1,'red');
        grd.addColorStop(.5, 'gray');
        grd.addColorStop(0,'green');
        }
        else
        {
        grd.addColorStop(0,'red');
        grd.addColorStop(.5, 'gray');
        grd.addColorStop(1,'green'); 
        }
        
        $id.fillStyle =grd;// 'hsl(220,60%,85%)';
        //$id.fillStyle = '#EEF';
        $id.beginPath();
        $id.arc(xc,yc,r1,0.1,Math.PI-0.1,true);
        $id.closePath();
        $id.fill();
        
        $id.fillStyle = '#AAF';
        $id.beginPath();
        $id.arc(xc,yc,15,0,Math.PI,true);
        $id.closePath();
        $id.fill();
        
        $id.strokeStyle = 'hsl( 30,99%,50%)'; 
                teta=0.0308*n;
        x1=xc-r3*Math.cos(teta);
        y1=yc-r3*Math.sin(teta);
        
        $id.beginPath();
        $id.lineWidth=8;
        
        $id.moveTo(xc,yc);
        $id.lineTo(x1,y1);
        $id.stroke();
       // teta+=0.0308;


    if(count===n)
        stop=true;

    ";

return $scr;
  }
 /**
  *setBackground
 */
  function setBackground($id,$dataURL ){

$scr="var backgroundImage = new Image(); ";
$scr.="dataURL = '$dataURL'; ";
$scr.="$id.drawImage(backgroundImage, 0, 0);";
  return  $scr;
}
/////////////////////////////////////////////
function setVar($id,$var,$val){
    return "var $var=$val;";
}
/////////////////////////////////////////
function onload($id,$dataURL){
    $scr="var imageObjeq = new Image();";
    $scr.="imageObjeq.src = '$dataURL';";
    $scr.="imageObjeq.onload = function() {";
    $scr.="$id.drawImage(this, 0, 0);";
     return  $scr;
}
/////////////////////////////////////////
function setFont($id,$font) {
     $scr="$id.font='$font';";
      return  $scr;
}
/////////////////////////////////////////
function rect($id,$startPoint2,$gap,$variable,$y_variable,$wd,$l_variable,$color){
$scr="$id.beginPath();";
$scr.="$id.fillStyle='$color';";
$y=$y_variable-$gap;
$scr.="$id.rect($startPoint2,$y_variable,$wd,$l_variable);";
    $scr.="$id.fill();";
 $scr.="$id.stroke();";
 
 
 $scr.="$id.fillStyle='black';";
$y=$y_variable-$gap;
$scr.="$id.fillText($variable,$startPoint2+2*$gap,$y);";
 $scr.="$id.stroke();";
 
 
  return  $scr;
}
 /////////////////////////////////////////
 function endScript(){
 return "};     </script></p>";
 }
}
