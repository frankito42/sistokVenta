<?php
session_start();
require "conn.php";
$user=$_GET['user'];
$pass=$_GET['pass'];
$sql="SELECT * FROM `users` WHERE `user`=:user AND `pass`=:pass";
$res=$conn->prepare($sql);
$res->bindParam(":user",$user);
$res->bindParam(":pass",$pass);
$res->execute();
$res=$res->fetch();

if($res==null){
    echo json_encode("mal");
}else{
    $_SESSION["user"]=$res;
    echo json_encode($res);
}
?>