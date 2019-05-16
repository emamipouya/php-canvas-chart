# php-canvas-chart
This project is a class to create canvas bar chart in php

Here there is an example to use it in Joomla


  JLoader::import('helpers.canvas', JPATH_COMPONENT);
    $_canvas = new canvasMaker();
    
    $id='metaCanvas'; $width='550'; $height='380';
      $bgURL = 'http://mysite/images/canvas_bg.png';
     $font='17px Arial';
     
// X start point

$startPoint2=3; 

// Maximum length of bars

$max1=235;

// scale 

$scale=ceil($max1/30);
$gap=10;

// X gap between bars

$xgap=90;

// Wide of bars

  $wd=30;
  
   // This function will return Javascript code to draw canvas bar chart
   
   
   $scr = $_canvas->graphColumn($id,$width,$height,$data,$bgURL,$font,$startPoint2,$max1,$gap,$xgap,$wd,$scale);
   
   
