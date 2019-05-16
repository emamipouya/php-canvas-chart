<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_neo
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Neo Model
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
  ///////////////////////////////////////////
  
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