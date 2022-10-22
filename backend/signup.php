<?php
header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
$link = mysqli_connect('localhost', 'stuhub', 'KYJ6pjh3ZnRfaE57');
mysqli_query($link,'use stuhub');
$name = $_GET['name'];
$pass = $_GET['pass'];
$searchUser = mysqli_query($link,"select username from users where username = $name");
if(!mysqli_fetch_object($searchUser)){
    $res = mysqli_query($link,"insert into users(username,password) values($name,$pass)");
    echo(true);
}else{
    echo('repeat username');
}
