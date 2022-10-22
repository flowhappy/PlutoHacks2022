<?php
header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
$link = mysqli_connect('localhost', 'stuhub', 'KYJ6pjh3ZnRfaE57');
mysqli_query($link,'use stuhub');
$name = $_GET['name'];
$type = strtolower($_GET['type']);
$content = $_GET['content'];
$searchType = mysqli_query($link,"select name from type where name = '$type'");
$resType = mysqli_fetch_assoc($searchType);
var_dump($content);
if(!$resType['name']){
    mysqli_query($link,"INSERT INTO type (name) VALUES ('$type')");
}
mysqli_query($link,"INSERT INTO `article`( `title`, `content`, `type`) VALUES ('$name','$content','$type')");
