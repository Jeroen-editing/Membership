<?php

    try {

    /****************** Initialisatie **************************************************/
    /***********************************************************************************/

        /**** $_srv gebruiken = "action" in onze formulieren ********/
        $_srv = $_SERVER['PHP_SELF'];

        /**** database connection en selection ********/
        include("../connections/pdo.inc.php");

        /**** functie om "menu" samen te stellen vanuit DB ********/
        include("../php_lib/menu.inc.php");

        /**** maak variabele selectie query ********/
        include("../php_lib/inlezen.inc.php");


    /***************** output **********************************************************/
    /***********************************************************************************/

        /**** $_smarty instantiëren en initialiseren ********/
        require("../smarty/mySmarty.inc.php");

        /**** We kennen de variabelen toe ********/
        $_smarty->assign('inhoud',inlezen("Y_home_I.html"));
        $_smarty->assign('commentaar',inlezen("Y_home_C.html"));
        $_smarty->assign('menu',menu(99));

        /**** display it ********/
        $_smarty->display('ledenadmin.tpl');
    }


    catch (Exception $_e) {

        /**** exception handling functions ********/
        include("../php_lib/myExceptionHandling.inc.php");
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }
?>
