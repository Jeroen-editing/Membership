<?php

    /****************** output *************************************************************/
    /***************************************************************************************/

    /**** $_smarty instantiëren en initialiseren ************/
    require_once("../smarty/mySmarty.inc.php");

    /**** functie om het menu op te stellen ************/
    require_once("../php_lib/menu.inc.php");

    /**** functie om de tekst/html in te lezen ************/
    require_once("../php_lib/inlezen.inc.php");

    /**** varaibelen toekennen ************/
    $_smarty->assign('inhoud', $_inhoud);
    $_smarty->assign('commentaar', inlezen($_commentaar));
    $_smarty->assign('menu', menu($_menu));

    /**** display it ************/
    $_smarty->display('ledenadmin.tpl');

?>