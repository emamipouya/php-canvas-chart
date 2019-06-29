<?php
/**
 * @package     Canvas PHP
 * 
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 

class canvasMaker {
    
public $color;//['1']="blue";

public function canvasMaker(){
    
    $this->color['9']='#88FFff';
    $this->color['8']='#AA55AA';
    $this->color['7']='#55AAAA';
    $this->color['6']='#AAAA00';
    $this->color['5']='#AAAAAA';
    $this->color['4']='#ffAAAA';
    $this->color['3']='#AAffAA';
    $this->color['2']='#AA99ff';
    $this->color['1']='#ffff99';
    $this->color['0']='#99ffff';
}
//////////////////////////////////////////////////////////
  function create($id,$width,$height,$border){
    // $border=2;
            $scr="<p><canvas id='$id' width='$width' height='$height' style='border:$border px solid #000000;'> HTML5 canvas tag is unsupported in your browse</canvas>";
     return  $scr;
  }
  /////////////////////////////////
  function   getCanvas($id){
     $scr="<script>
     var eqt = document.getElementById('$id');
     var $id = eqt.getContext('2d');";
   return  $scr;
  }
  
/*
*   Draw Column Graph 
*/
  function graphColumn($id,$width,$height,$data,$bgURL,$font,$startPoint2,$max1,$gap,$xgap,$wd,$scale){
        $b=2;
        $res=$this->create($id,$width,$height,$b);
        $res.=$this->getCanvas($id);
        $res.=$this->setBackground($id,$bgURL);
        $res.=$this->setFont($id,$font);
        $res.=$this->onload($id,$bgURL);
 
        $i=1;
        $colorNum=sizeof($this->color);
        foreach($data as $var){
            $l_variable=$var*$scale;
            $y_variable=$max1-$l_variable;
            $startP=$startPoint2+$i*$xgap;
            $j=$i%$colorNum;//10;
            $color=$this->color[$j];
            $res.=$this->rect($id, $startP,$gap,$var,$y_variable,$wd,$l_variable,$color);
            $i++;
        }
        $res.=$this->endScript();
  return $res;
  }
  /**
   * bar chart with lable
   */
   
     function barLabels($data,$config,$label){
         $id=$config['id'];
         $width=$config['width'];
         $height=$config['height'];
         $bgURL=$config['bgURL'];
         $font=$config['font'];
         $startPoint2=10;//$config['startPoint2'];
         $max1=$config['max1']-60;;
         $gap=10;//$config['gap'];
         $xgap=ceil($width/(sizeof($data)+1));//$config['xgap'];
         $wd=$config['wd'];
         $scale=$max1/100;//ceil($width/120);//$config['scale'];
         
        $b=2;
        $res=$this->create($id,$width,$height,$b);
        $res.=$this->getCanvas($id);
         $res.=$this->setFont($id,$font);
        $res.=$this->gridCanvas($id,$width,$height,$max1,$font);
       
        if(strlen($bgURL)>4)
        {
            $res.=$this->setBackground($id,$bgURL);
            $res.=$this->onload($id,$bgURL);
        }
        else
        {
            $func=$id.'_action';
            $res.="
            document.addEventListener('DOMContentLoaded', $func);
            function $func(){
                ";
        }
        
 
        $i=1;
        $colorNum=sizeof($this->color);
         
        foreach($data as $var){
            $l_variable=ceil($var*$scale);
            $y_variable=$max1-$l_variable;
            $startP=$startPoint2+$i*$xgap;
            $j=$i%$colorNum;//10;
            $color=$this->color[$j];
            $res.=$this->rect($id, $startP,$gap,$var,$y_variable,$wd,$l_variable,$color);
            $txt=$label[$i];
            $res.=$this->text($id, $startP,$txt,$max1,$font);
            $i++;
        }
        $res.=$this->endScript();
  return $res;
  }
  /**
   * Insert Text for Grid
   */
   function text($id, $x,$txt,$max1){
       
        $src="
        $id.fillStyle='black';
    $id.save();
    $id.translate($x,$max1+15);
    $id.rotate(-Math.PI / 2);
    $id.fillText('$txt', 5, 5);
    $id.restore();

        $id.stroke();

        ";
        return $src;
   }
  /**
   *  Generate Grid
   */
   function gridCanvas($id,$width,$height,$max1){
     $floor=$max1;//$height-10;
     $stp=$floor/10;
    $scr="
        x1=30;
        ygap=5;
        $id.beginPath();
        $id.fillStyle='#ccf';
        $id.rect(1,1,$width,$height);
        $id.fill();
        
        $id.beginPath();
        $id.fillStyle='#eee';
        $id.rect(6,6,$width-10,$floor-ygap);
        $id.fill();
        
        $id.beginPath();
        $id.fillStyle='#444';
        $id.rect(1,$floor,$width-2,2);
        $id.fill();
        
            $id.beginPath();
        $id.fillStyle='#aaf';
        $id.rect(5,ygap,x1,$floor-ygap);
        $id.fill();
        
        $id.stroke();
        $id.fillStyle='black';
        for(k=1;k<10;k++){
        
        y1=$floor-$stp*k;
        val=k*10;
        $id.fillText(val,x1,y1);
        $id.rect(5,y1,$width-2,1);
        }
        $id.stroke();
        
    
    ";

  return  $scr;
}
  ////////////////////////////////////////Guage ////////////////
  /////////////////////////////////////////////////////////////
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
    //////////////////////////////////////////
  
  function setParamGauge($id,$n,$r,$lowestBest){

       
       return $scr;
  }
  //////////////////////////////////////////
  
  function initiateGauge($id,$r,$n,$lowestBest,$title,$font){
      $func=$id.'_action';
        $scr="
        
        var teta=0.0;
        var stop=false;
        
        var count=0;
        var xc=170;
        var yc=200;
        var r=$r;
        var r1=r+20;
        var r2=r+40;
        var r3=r+27;
        var lowbeter=$lowestBest;
        
        document.addEventListener('DOMContentLoaded', $func);
        function $func(){
                
                $id.font='$font';
                $id.fillStyle = '#000';
                $id.beginPath();
                $id.arc(xc,yc,r2+30,0.1,Math.PI-0.1,true);
                $id.closePath();
                $id.fill();
                
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
                var n=$n;
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