<?php
header("Access-Control-Allow-Origin: *");	
	
  $imageUrl = $_FILES['file']['tmp_name'];		
  $name = $_POST['name'];
  $folder = $_POST['folder'];
  $path = "img/$folder/$name.png";
  move_uploaded_file($imageUrl,$path);

?>