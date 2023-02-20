<?php
require 'DB/DB_Linea.php';
// Recibo los datos de la imagen
$nombre_img = $_FILES['imagen']['name'];
$imageType = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];
$sourceImagePath = $_FILES['imagen']['tmp_name'];
date_default_timezone_set('America/La_Paz');
    $date = date('Y/m/d h:i:s a', time());
    
    $date = str_replace('/', '', $date);
    $date = str_replace(':', '', $date);
    $date = str_replace(' ', '', $date);
$destinationImagePath = $date;
$maximumDimension = 2000;
$carpeta = '../img/lineas';

$carpeta2 = 'img/lineas/'.$destinationImagePath.".png";
$destinationImagePath = $carpeta."/".$destinationImagePath.".png";

if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 30000000)) 
{
   //indicamos los formatos que permitimos subir a nuestro servidor
   if (($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpg")
   || ($_FILES["imagen"]["type"] == "image/pjpeg")
   || ($_FILES["imagen"]["type"] == "image/png")
   || ($_FILES["imagen"]["type"] == "image/x-png"))
   {
    $resultSave = false; 
    list($width, $height) = getimagesize($sourceImagePath); 
    
    if(($maximumDimension >= $width) && ($maximumDimension >= $height)) { 
      $resultSave = move_uploaded_file($sourceImagePath, $destinationImagePath); 
    } 
    else { 
      $sourceImage = createImageFactory($sourceImagePath, $imageType); 
      if($width > $height) { 
        $newWidth = round($maximumDimension); 
        $newHeight = round($height * ($newWidth / $width)); 
      } 
      else { 
        $newHeight = round($maximumDimension); 
        $newWidth = round($width * ($newHeight / $height)); 
      } 
      $destinationImage = createNewImage($newWidth, $newHeight, $imageType); 
      $resultResize = imagecopyresampled($destinationImage, $sourceImage,  
                      0, 0, 0, 0, $newWidth, $newHeight, $width, $height); 
                       
      if($resultResize) { 
        $resultSave = saveImage($destinationImage, $destinationImagePath, $imageType); 
      } 
    } 
	if($resultSave){
		//se guardo correctamente
		//SIEMPRE SERA POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
			//el nombre esta en $destinationImagePath2
			$retorno = DB_Linea::updateImg(
      $_POST['id_linea'],
			$carpeta2);
			if ($retorno) {
				echo '<img src=\''.$carpeta2.'\' class="img-responsive" height="600" width="500"/>';
			}
		}
	}else{
		
		//la imagen no se pudo guardar
	}
  }
} 
else 
{
   
}
  function createImageFactory($imagePath, $imageType) { 
    $image = null; 
    if($imageType == "image/png") { 
      $image = imagecreatefrompng($imagePath); 
    } 
    else { 
      $image = imagecreatefromjpeg($imagePath); 
    } 
    return $image; 
  } 
  function saveImage($image, $imagePath, $imageType) { 
    $resultSave = false; 
    $resultSave = imagepng($image, $imagePath); 
    return $resultSave; 
  } 
  //----------------------------------------------------------------------------- 
  function createNewImage($width, $height, $imageType) { 
    $image = imagecreatetruecolor($width, $height); 
    // set the transparency if the image is png or gif 
    if($imageType == "image/png") { 
      imagealphablending($image, false); 
      imagesavealpha($image, true); 
      $transparent = imagecolorallocatealpha($image, 255, 255, 255, 127); 
      imagefilledrectangle($image, 0, 0, $width, $height, $transparent); 
    } 
    return $image; 
  } 
?>