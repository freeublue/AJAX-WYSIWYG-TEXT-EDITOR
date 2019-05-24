<?
$fill = strtolower($_FILES['userfile'] ['name']);
$fil = substr($fil1, -3); 
$filj = substr(fill, -4);
$tmpName = $_FILES['userfile'] ['tmp_name'];
$imagearray = getimagesize($tmpName);


$valid_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);









if (in_array($imagearray[2],  $valid_types)) { 


$fileName = $_FILES['userfile'] ['name'];
$tmpName = $_FILES['userfile'] ['tmp_name'];
$fileSize = $_FILES['userfile'] ['size'];

$fp = fopen($tmpName, 'r');
$content = fread($fp, $fileSize);
$content = addslashes($content);
fclose($fp);
$picture = str_replace(' ', '_', $tmpName);

$source = $picture;
$na = 'f' . time();
$target = 'pic/' . $fileName;
$newname = 'pic/' . $na . '.jpg';
$newna = 'pic/' . $na . '.jpg';
move_uploaded_file($source, $newname );
$newname = 'pic/' . $na . '.jpg';

$image = $newname;
 } else { 
echo "the type of file is not acceptable, go back and try again";  } 



echo "$image";
?>
