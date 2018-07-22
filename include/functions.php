<?php
include("include/dbconnect.php"); 

function GetAppName($project_id){
    $dbname     = "app_manager";
    $dbserver   = "mariadb101.websupport.sk";
    $dbuser     = "app_manager";
    $dbpass     = "ZljaMxcUux";

    /*$dbname     = "app_manager";
    $dbserver   = "localhost";
    $dbuser     = "root";
    $dbpass     = "";*/
    $link = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname,3312);

    $sql="SELECT app_name from app_list where app_id=$project_id";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $app_name=$row['app_name'];
    }  return $app_name;  

    mysqli_close($link);
}

function GetAppHashTag($project_id){
    $dbname     = "app_manager";
    $dbserver   = "mariadb101.websupport.sk";
    $dbuser     = "app_manager";
    $dbpass     = "ZljaMxcUux";

    /*$dbname     = "app_manager";
    $dbserver   = "localhost";
    $dbuser     = "root";
    $dbpass     = "";*/
    $link = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname,3312);

    $sql="SELECT app_hashtag from app_list where app_id=$project_id";
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $app_hashtag=$row['app_hashtag'];
    }  return $app_hashtag;  

    mysqli_close($link);
}