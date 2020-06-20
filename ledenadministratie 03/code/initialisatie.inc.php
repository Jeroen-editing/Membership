<?php

    /**** $_srv = "action" in de formulieren ************/
    $_srv = $_SERVER['PHP_SELF'];

    $_inhoud = "";
    
    /**** instantiëring van $_PDO ************/
    /**** connectie met dbms en selectie v/d database ************/
    require("../connections/pdo.inc.php");

    /**** model v/d database, based on drop-downs ************/
    require("../php_lib/dropDown.inc.php");

    /**** functie om selectie te maken ************/
    require("../php_lib/createSelect.inc.php");

    /**** primary key van t-gemeente (p?) om te zoeken op basis van gemeente, naam en/of postcode ************/
    require("../php_lib/PK_t_gemeente.inc.php");

?>