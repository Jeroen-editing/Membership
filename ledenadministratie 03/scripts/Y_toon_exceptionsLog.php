<?php

    try {

    /****************** Initialisatie **************************************************/
    /***********************************************************************************/

        /**** $_srv gebruiken = "action" in onze formulieren ********/	
        $_srv = $_SERVER['PHP_SELF'];

        /**** includes **************/
        /****************************/

        /**** database connection en selection ********/
        include("../connections/pdo.inc.php");
        
        /**** maak variabele selectie query ********/
        require("../php_lib/inlezen.inc.php");

    
    /************* (Input en) verwerking ***********************************************/
    /***********************************************************************************/

        if (!isset($_POST["submit"])) {

            /**** als er geen formulier is ********/

            /**** ==> toon formulier       ********/

            /**** default - waarde voor datumvelden (start - einde) ********/
            /**** let op !! datum formaat voor formulier ==> "jaar-maand-dag" ********/
            $_vandaag = strftime("%Y-%m-%d");

            /**** het formulier ********/
            $_inhoud = "
                <h1>Exception-log</h1>
                <p>Toon exceptions tussen</p>
                <form method='post' action='$_srv'>
                    <input type='date' name='start' value='$_vandaag'>
                    <input type='date' name='einde' value='$_vandaag'>
                    <div class='clearfix'></div>
                    <br>
                    <input type='submit' name='submit' value='toon'>
                </form>";

        } else {

        /**** inhoud formulier verwerken ********/
        /****************************************/
            
            /**** input uitpakken (start en einde) ********/
            /**** let op !! datum formaat voor formulier ==> "jaar-maand-dag" ********/


            /**** startdag omzetten naar timestamp (0 uur 0 min 0 sec) ********/
            /******************************************************************/

            /**** 1) "jaar-maand-dag" splitsen ********/
            $_sDatum = $_POST['start'];
            list($_jaar, $_maand, $_dag) = explode("-", $_sDatum, 3);
            /**** explode("-", $_POST['start'], 3); ********/

            /**** 2) start-datum voor in scherm output ********/
            $_sDatum = $_dag."-".$_maand."-".$_jaar;

            /**** 3) om te gebruiken in vergelijkingen ==> start dag omzetten naar timestamp ********/
            /**** mktime(uur,min,sec,maand,dag,jaar) ********/
            $_start = mktime(0, 0, 0, $_maand, $_dag, $_jaar);


            /**** einddag omzetten naar timestamp (23 uur, 59 min, 59 sec) ********/
            /**********************************************************************/

            /**** 1) "jaar-maand-dag" splitsen ********/
            $_eDatum = $_POST['einde'];
            list($_jaar, $_maand, $_dag) = explode("-", $_eDatum, 3);
            /**** explode("-", $_POST['einde'], 3); ********/

            /**** 2) eind-datum voor in scherm output ********/
            $_eDatum = $_dag."-".$_maand."-".$_jaar;

            /**** 3) om te gebruiken in vergelijkingen ==> einde dag omzetten naar timestamp ********/
            /**** mktime(uur,min,sec,maand,dag,jaar) ********/
            $_einde = mktime(23, 59, 59, $_maand, $_dag, $_jaar);


        /**** CSV-file ==> ../logs/error_log.csv <== verwerken ********/
        /**************************************************************/

            /**** CSV-file openen ********/
            $_pointer = fopen("../logs/error_log.csv","rb");

            /**** als openen CSV-file niet lukt ==> error-melding geven ********/
            if (! $_pointer) {
    
                throw new Exception("Opening error_log failed");
            }

            /**** initialisaties ********/
            $_inhoud = "";
            
            $_exceptionCounter= 0;

            /**** CSV-file uitlezen ********/
            while(! feof($_pointer)) {

                $_error_log = fgetcsv($_pointer);

                if (! feof($_pointer)) {
                    
                    /**** inhoud CSV splitsen ********/
                    list($_tijd, $_msg, $_script, $_lijn) = $_error_log;

                    /**** let op !! formaat in $_tijd is 'dag-maand-jaar uur:min:sec' ********/
                    /**** inhoud $_d exploderen met " " ********/
                    /**** splitsen in 2 delen ==> datum = $_d en tijd = $_t ********/
                    list($_d, $_t) = explode(" ", $_tijd, 2);

                    /**** let op !! formaat in $_d is ==> "dag-maand-jaar" ********/
                    /**** inhoud $_d exploderen met "-" ********/
                    /**** splitsen in 3 delen ==> $_dag + $_maand + $_jaar ********/
                    list($_dag, $_maand, $_jaar) = explode("-", $_d, 3);

                    /**** errordatum omzetten naar timestamp (0 uur, 0 min, 0 sec,...) ********/
                    $_errorDatum = mktime(0, 0, 0, $_maand, $_dag, $_jaar);

                    /**** vergelijk de gelezen datum (error-log datum) ********/
                    /**** ... met de gegeven datums (in het formulier) ********/
                    if($_errorDatum >= $_start && $_errorDatum <= $_einde) {

                        /**** alleen tonen als er een fout is tussen start en eind ********/
                        /**** ==> omgekeerde volgorde ********/

                        $_inhoud = "
                            <p>
                                <span class='errorLabel'>Wanneer :</span>$_tijd<br>
                                <span class='errorLabel'>Script :</span>$_script<br>
                                <span class='errorLabel'>Lijn nr :</span>$_lijn<br>
                                <span class='errorLabel'>Wat :</span>$_msg<br>
                            </p>
                            <hr><br>".$_inhoud;
                            
                        $_exceptionCounter++;

                    }
                }
            }

            /**** output aanmaken ********/
            /**** titel vooraan plaatsen ********/

            $_inhoud = "
                <h1>Exceptions</h1>
                <br>
                <p>
                    <strong>$_exceptionCounter</strong>
                    exceptions tussen $_sDatum ('s morgens) en $_eDatum('s avonds)
                </p>".$_inhoud;

            /**** CSV-file sluiten ********/
            fclose($_pointer);

        }

    /***************** output **********************************************************/
    /***********************************************************************************/

        /**** menu definiëren ********/ 
        $_menu =  99;
        /**** commentaar file definiëren ********/  
        $_commentaar = inlezen('Y_tonen_C.html');
  
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