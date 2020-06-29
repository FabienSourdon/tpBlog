<?php 
$cssOn = [];
$cssOn[] = './css/create.css';
session_start();
//var_dump($_SESSION);
include('./phtml/head.phtml');
include('./phtml/create.phtml');
include('./phtml/foot.phtml');
?>