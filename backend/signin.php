<?php
header('Content-Type:application/json');
header("Access-Control-Allow-Origin: *");
$link = mysqli_connect('localhost', 'stuhub', 'KYJ6pjh3ZnRfaE57');
mysqli_query($link,'use stuhub');
$name = $_GET['name'];
$pass = $_GET['pass'];
$searchUser = mysqli_query($link,"select password from users where username = '$name'");
$pwd = mysqli_fetch_assoc($searchUser)['password'];
if($pwd&&$pwd===$pass){
    echo(true);
}else{
    echo('Wrong username or password');
}
