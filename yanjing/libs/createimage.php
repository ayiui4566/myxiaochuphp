<?php
/*
注意调用该函数时候，把图片的文件名都转换成小写。
createThumb()是 非等比压缩，效果没这么好。
createImage()是等比压缩函数，效果比较好。

*/


function createThumb($filename) {
	// 261x195
	$final_width_of_image = 250;
	$final_height_of_image = 200;
	$path_to_image_directory = '../files/';
	$path_to_thumbs_directory = '../files/thumb/';
	
	if(preg_match('/[.](jpg)$/', $filename)) {
		$im = imagecreatefromjpeg($path_to_image_directory . $filename);
	} else if (preg_match('/[.](gif)$/', $filename)) {
		$im = imagecreatefromgif($path_to_image_directory . $filename);
	} else if (preg_match('/[.](png)$/', $filename)) {
		$im = imagecreatefrompng($path_to_image_directory . $filename);
	}
	
	$ox = imagesx($im);
	$oy = imagesy($im);
	
	$nx = $final_width_of_image;
	$ny = floor($oy * ($final_width_of_image / $ox));
	if($ny>$final_height_of_image){
		$ny = $final_height_of_image;
		$nx = floor($ox * ($ny / $oy));
	}
	$nm = imagecreatetruecolor(250,200);
	$white = imagecolorallocate($nm, 255, 255, 255);
	imagefill($nm, 0, 0, $white);
	
	$offset_x = floor((250 - $nx) / 2);
	$offset_y = floor((200 - $ny) / 2);
	
	imagecopyresampled($nm, $im, $offset_x, $offset_y,0,0,$nx,$ny,$ox,$oy);
	
	if(!file_exists($path_to_thumbs_directory)) {
	  if(!mkdir($path_to_thumbs_directory)) {
           die("There was a problem. Please try again!");
	  } 
    }
	imagejpeg($nm, $path_to_thumbs_directory . $filename, 75);
}





function createImage($filename) {
	// 600x480
	$final_width_of_image = 600;
	$path_to_image_directory = '../files/';
	$path_to_thumbs_directory = '../files/';
	
	if(preg_match('/[.](jpg)$/', $filename)) {
		$im = imagecreatefromjpeg($path_to_image_directory . $filename);
	} else if (preg_match('/[.](gif)$/', $filename)) {
		$im = imagecreatefromgif($path_to_image_directory . $filename);
	} else if (preg_match('/[.](png)$/', $filename)) {
		$im = imagecreatefrompng($path_to_image_directory . $filename);
	}
	
	$ox = imagesx($im);
	$oy = imagesy($im);
	
	$nx = $final_width_of_image;
	$ny = floor($oy * ($final_width_of_image / $ox));
	if($ny>$final_width_of_image){
		$ny = $final_width_of_image;
		$nx = floor($ox * ($ny / $oy));
	}	
	$nm = imagecreatetruecolor($nx, $ny);
	
	imagecopyresampled($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
	
	if(!file_exists($path_to_thumbs_directory)) {
	  if(!mkdir($path_to_thumbs_directory)) {
           die("There was a problem. Please try again!");
	  } 
    }
	imagejpeg($nm, $path_to_thumbs_directory . $filename, 75);
	
}

?>