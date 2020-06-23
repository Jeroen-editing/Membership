<?php
$_srv = $_SERVER['PHP_SELF'];
$_inhoud="";

// instantiering van $_PDO 
// (connectie met dbms en selectie van de datbase)
require_once("../connections/pdo.inc.php");

// model (database) based drop-downs  
require_once("../php_lib/dropDown.inc.php");
// functie om selectie query samen te stellen  
require_once("../php_lib/createSelect.inc.php");  
// primary key van t_gemeente p te zoeken op basis van gemeente naam en/of postcode
require_once("../php_lib/PK_t_gemeente.inc.php");  
// inklezen van files 
require_once("../php_lib/inlezen.inc.php");
?>