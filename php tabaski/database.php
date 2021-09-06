<?php 
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=espacemembre;charset=utf8;','root', '');
}catch(Exception $e){
    echo " base non connecté";
}

?>