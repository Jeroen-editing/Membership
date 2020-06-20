<?php

    try {

    /********************** Initialisatie ************************************************/
    /*************************************************************************************/

        require_once("../code/initialisatie.inc.php");

    /****************** Input en verwerking ***********************************************/
    /**************************************************************************************/

        /**** welkom.txt zal in het 'inhoud'-veld op het schermgetoond worden ********/
        require_once("../php_lib/inlezen.inc.php"); 
          
        $_inhoud = inlezen('A_home_I.html');
        

    /***************** output *************************************************************/
    /**************************************************************************************/
      
        /**** menu definiëren ********/
        $_menu = 0;
        
        /**** commentaar file definiëren ********/
        $_commentaar = 'A_home_C.html';
        
        require("../code/output.inc.php");

    }

    catch (Exception $_e) {

        /**** exception handling functions ********/ 
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>
