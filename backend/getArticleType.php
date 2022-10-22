<?php
header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
$link = mysqli_connect('localhost', 'stuhub', 'KYJ6pjh3ZnRfaE57');
mysqli_query($link,'use stuhub');
$article_title = mysqli_query($link,'select name from type');
$article_titles=[];
while($res = mysqli_fetch_object($article_title)) $article_titles[] = $res;
echo (json_encode($article_titles));