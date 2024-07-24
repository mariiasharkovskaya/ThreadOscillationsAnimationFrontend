<?php

set_time_limit(60);

$w1 = $_GET["w1"];
$T1 = $_GET["T1"];

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/forcedFigures")) {
    mkdir($_SERVER['DOCUMENT_ROOT'] . "/forcedFigures", 0777, true);
}

$mytifspath = $_SERVER['DOCUMENT_ROOT'] . "/forcedFigures"; // your image directory
// Deleting all the files in the list 
$files = glob($mytifspath . '/*');  
foreach($files as $file) { 
   
    if(is_file($file))  
    
        // Delete the given file 
        unlink($file);  
} 

$output = null;
$retval = null;
exec("forcedOsc.exe $w1 $T1", $output, $retval);
//system($_SERVER['DOCUMENT_ROOT'] . "/forcedOsc.exe");
print_r($output);
//exit();

$multiTIFF = new Imagick();



//$files = scandir($mytifspath);
$files = glob($mytifspath . '/*');  

//print_r($files);
   
//foreach( $files as $f )
//{

// 0 - .
// 1 - ..
//for($i=2;$i<7;$i++)
foreach($files as $file)
{
    //echo $files[$i];
    
    //echo "<br>";
    $auxIMG = new Imagick();
    //$auxIMG->readImage($mytifspath."/".$files[$i]);
    $auxIMG->readImage($file);
   
    $multiTIFF->addImage($auxIMG);
}

//file multi.TIF
//$multiTIFF->writeImages('multi423432.gif', true); // combine all image into one single image
$multiTIFF->writeImages($_SERVER['DOCUMENT_ROOT'] . '/multi.gif', true);

// //files multi-0.TIF, multi-1.TIF, ...
// $multiTIFF->writeImages('multi.gif', false);


$multiTIFF->destroy();




// $showImagick = new Imagick();
// $showImagick->readImage($mytifspath . '/multi.gif');

// /* Give the image a format */
// $showImagick->setImageFormat( 'gif' );

// /* Send headers and output the image */
// header( "Content-Type: image/{$showImagick->getImageFormat()}" );
// echo $showImagick->getImageBlob( );

echo "<img src=\"multi.gif\" />"

?>