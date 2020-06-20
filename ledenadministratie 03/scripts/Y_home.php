<?php

    try {

        /****************** Initialisatie *****************************************************/
        /**************************************************************************************/

            require("../code/initialisatie.inc.php");


        /***************** input en verwerking ************************************************/
        /**************************************************************************************/

            require_once("../php_lib/inlezen.inc.php");

            $_inhoud = inlezen("A_home_I.html");


        /***************** output *************************************************************/
        /**************************************************************************************/
        
            /**** menu definieren ********/ 
            $_menu =  99;

            /**** Commentaar file definiëren ********/
            $_commentaar = inlezen("Y_home_C.html");

        
            require("../code/output.inc.php");
            /**** bevat alle code die nodig is om de output te genereren ************/
            /**** instantiëring v/h smarty-object                        ************/
            /**** toewijzen van de smarty variabelen                     ************/
            /**** koppeling met de gewenste template                     ************/
        
    }


    catch (Exception $_e) {

        /**** exception handling functions ********/ 
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }
?>