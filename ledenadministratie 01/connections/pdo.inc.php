<?php
error_reporting(13);

if ($_SERVER['SERVER_NAME'] != "localhost")
{
  $hostname = "";
  $username = "";
  $password = "";
  $database = "";
}
else
{
  $hostname = "localhost";
  $username = "root";
  $password = "root";
  $database = "db_ledenadmin_02_start";
}
  $_PDO = new PDO("mysql:host=$hostname; dbname=$database","$username", "$password");
  
 $_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>