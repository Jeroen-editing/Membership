<?php

    try {

    /********************** Initialisatie **********************************************/
    /***********************************************************************************/

        $_srv = $_SERVER['PHP_SELF'];

        /**** includes **************/
	    /****************************/

        /**** database connection en selection ********/
        include("../connections/pdo.inc.php");

        /**** menu creatie vanuit de DB ********/
        include("../php_lib/menu.inc.php"); 

        /**** maak variabele selectie query ********/
        include("../php_lib/inlezen.inc.php"); 
        
        $_inhoud=inlezen("L_home_I.html");
        $_commentaar=inlezen("L_home_C.html");


    /***************** output **********************************************************/
    /***********************************************************************************/
      
        /**** $_smarty instantiëren en initialiseren ********/ 
        require("../smarty/mySmarty.inc.php");

        /**** We kennen de variabelen toe ********/
        $_smarty->assign('inhoud',$_inhoud);
        $_smarty->assign('commentaar',$_commentaar);
        $_smarty->assign('menu',menu(1));

        /**** display it ********/
        $_smarty->display('ledenadmin.tpl');

    }

    catch (Exception $_e) {

        /**** exception handling functions ********/ 
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>