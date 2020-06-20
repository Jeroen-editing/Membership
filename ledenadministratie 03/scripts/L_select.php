<?php

    try {
    
        /********************** Initialisatie ************************************************/
        /*************************************************************************************/

            require("../code/initialisatie.inc.php");

            
        /****************** Verwerking ********************************************************/
        /**************************************************************************************/

        /**** is het script op een 'legale' manier opgestart ************/
        /**** is er een actie gedefiniëerd                   ************/
        /****                                                ************/
        /**** anders ==> illegale toegang                    ************/
        if (! isset($_GET["act"])) {

            /**** geen actie gedefiniëerd **********/
            throw new Exception("illegal access");

        }

        /**** de actie vanuit $_GET naar de sessie variabele kopiëren ************/
        $_SESSION["actie"] = $_GET["act"];
        printf($_GET["act"]);

        /**** verschillende details voor de verschillende acties                         ************/
        /**** $_srv ==> volgende functie/script                                          ************/
        /**** $_SESSION['comment'] ==> text die in het commentaar-veld v/d template komt ************/
        /**** $_start ==> start-positie voor de drop-downs (soor lid & gender)           ************/
        switch ($_SESSION["actie"])	{

            /**** lezen **********/		
            case 1:
                $_srv = "../scripts/l_tonen.php";
                $_SESSION['comment']= "L_lezen_C.html";
                $_start = 0;
            break;
                
            /**** toevoegen **********/
            case 2:
                $_srv = "../scripts/l_toevoegen.php";
                $_SESSION['comment'] = "L_toevoegen_C.html";
                $_start = 1;
            break;
        
            /**** verwijderen **********/
            case 3:
                $_srv = "../scripts/l_verwijderen.php";
                $_SESSION['comment'] = "L_verwijderen_C.html";
            break;
            
            /**** aanpassen **********/
            case 4:
                $_srv = "../scripts/l_aanpassen.php";
                $_SESSION['comment'] = "L_aanpassen_C.html";
                $_start = 0;			
            break;
                    
            /**** alle andere waarden **********/
            default: 
                throw new Exception("Illegal action");
        
        }
        
        /**** selectie formulier **********/
        require("../code/selectionForm.inc.php");
            

        /***************** output *************************************************************/
        /**************************************************************************************/
        
            /**** menu initialiseren ********/ 
            $_menu = 1;
            
            /**** links commentaar veld initialiseren ********/ 
            $_commentaar = $_SESSION['comment'];


            require("../code/output.inc.php");
            /**** bevat alle code die nodig is om de output te genereren ****/
            /**** instantiëring v/h smarty-object                        ****/
            /**** toewijzen van de smarty variabelen                     ****/
            /**** koppeling met de gewenste template                     ****/

    }

    catch (Exception $_e) {

        /**** exception handling functions ********/ 
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>