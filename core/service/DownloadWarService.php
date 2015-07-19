<?php
require(dirname(dirname(__FILE__)).'/util/autoload.php');
use core\util\PropertiesConfig as PropertiesConfig;

ini_set('memory_limit', '-1');
$name = $_GET['name'];
$build = $_GET['build'];
$file;
foreach (glob("/var/www/html/qualityreport/released/".$build."/*/".$name.".*") as $filename) {
    $file = $filename;
}
if(!file_exists($file)){
//    echo "<script type=\"text/javascript\">";
//    echo "alert(\"OKOK\");";
//    echo "<//script>";
    $msg = urlencode("File Not Found!!");
    header("Location: ../../views/qualityreport.php?msg=" . $msg);
    exit();
}

$pathname = dirname($file);
$path =  basename($pathname)."-".$build;
$pathsearch = PropertiesConfig::get("download.tar.path");

if(file_exists($pathsearch."/".$path.".tar")){
    
} else {
    $phar = new PharData($path.".tar");
    $phar->buildFromDirectory($pathname);
    unset($phar);
    rename(dirname(__FILE__).'/'.$path.".tar", $pathsearch."/".$path.".tar");
}
foreach (glob($pathsearch."/".$path.".tar") as $filename2) {
    $file2 = $filename2;
}
//header("Pragma: public");
//header("Expires: 0"); // set expiration time
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
//// browser must download file from server instead of cache

// force download dialog
//header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
//header("Content-Type: application/download");

// use the Content-Disposition header to supply a recommended filename and 
// force the browser to display the save dialog. 
header("Content-Disposition: attachment; filename=".basename($file2).";");

/*
The Content-transfer-encoding header should be binary, since the file will be read 
directly from the disk and the raw bytes passed to the downloading computer.
The Content-length header is useful to set for downloads. The browser will be able to 
show a progress meter as a file downloads. The content-lenght can be determines by 
filesize function returns the size of a file. 
*/
//header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($file2));
readfile($file2);
exit();
?>