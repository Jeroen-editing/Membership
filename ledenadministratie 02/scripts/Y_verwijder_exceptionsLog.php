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
        include("../php_lib/inlezen.inc.php");

        
    /************* (Input en) verwerking ***********************************************/
    /***********************************************************************************/

        if (! isset($_POST["submit"])) {

            /**** als er geen formulier is ********/

            /**** ==> toon formulier       ********/

            /**** default - waarde voor datumvelden (start - einde) ********/
            /**** let op !! datum formaat voor formulier ==> "jaar-maand-dag" ********/
            $_vandaag = strftime("%Y-%m-%d");

            /**** het formulier ********/
            $_output = "
                <h1>Exception-log</h1>
                <form methode='post' action='$_srv'>
                    <p>Verwijder Exceptions tot en met </p>
                    <br>
                    <input type='date' name='einde' value='$_vandaag'>
                    <div class='clearfix'></div>
                    <br>
                    <input type='submit' name='submit' value='verwijder'
                </form>";

        } else {

        /**** inhoud formulier verwerken ********/
        /****************************************/

            /**** input uitpakken eind-dag ********/
            /**** let op !! datum formaat voor formulier ==> "jaar-maand-dag" ********/


            /**** (eind) datum omzetten naar timestamp (23 uur, 59 min, 59 sec) ********/
            /**********************************************************************/

            /**** 1) "jaar-maand-dag" splitsen ********/
            $_datum = $_POST['einde'];
            list($_jaar, $_maand, $_dag) = explode("-", $_datum, 3);

            /**** 2) datum voor in scherm output ********/
            $_datum = $_dag."-".$_maand."-".$_jaar;

            /**** 3) om te gebruiken in vergelijkingen ==> einde-dag omzetten naar timestamp ********/
            /**** mktime(uur,min,sec,maand,dag,jaar) ********/
            $_einde = mktime(23, 59, 59, $_maand, $_dag, $_jaar);


        /**** CSV-file ==> ../logs/error_log.csv <== verwerken ********/
        /**************************************************************/

            /**** actuele CSV-file openen = A ********/
            $_pointerA = fopen("../logs/error_log.csv","rb");

            /**** als openen CSV-file niet lukt ==> error-melding geven ********/
            if (! $_pointerA) {

                throw new Exception("Opening actual error_log failed");
            }

            /**** tijdelijke CSV-file openen = T ********/
            $_pointerT = fopen("../logs/temporary_error_log.csv","w+b");

            /**** als openen CSV-file niet lukt ==> error-melding geven ********/
            if (! $_pointerT) {

                throw new Exception("Opening temporary error_log failed");
            }

            /**** initialisaties ********/
            $_output = "";
            
            $_exceptionCounter= 0;

            /**** actuele CSV-file uitlezen ********/
            while(! feof($_pointerA)) {

                $_error_log = fgetcsv($_pointerA);

                if (! feof($_pointerA)) {

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

                    /**** vergelijk de gelezen datum (error-log datum) ... ********/
                    /**** ... met de gegeven eind-datum (in het formulier) ********/
                    if($_errorDatum <= $_einde) {

                        /**** als gelezen datum (error-log) kleiner is dan de gegeven datum (formulier) ********/
                        /**** moet de exception verwijderd worden. ********/
                        /**** hij word dan niet gekopiëerd naar de tijdelijke file ********/
                        /**** we tellen we de verwijderde exceptions ********/
                        $_exceptionCounter++;

                    } else {

                    fputcsv($_pointerT, $_error_log) ;
                    }
                }
            }

            /**** einde kopiëren ********/
            /**** beide csv files (A & T) worden aggesloten ********/
            fclose($_pointerA);
            fclose($_pointerT);

            /**** de actuele error-log (error-log.csv) word verwijderd ********/
            unlink("../logs/error_log.csv");

            /**** en de tijdelijke error-log wordt hernoemd naar de actuele error-log ********/
            rename("../logs/temporary_error_log.csv","../logs/error_log.csv");

            /**** output aanmaken ********/
            /**** titel vooraan plaatsen ********/
            $_output = "
            <h1>Exceptions</h1>
            <br>
            <p>
                Alle exceptions (<em>$_exceptionCounter</em>) tot en met $_eDatum, zijn verwijderd.
            </p>"

        }

    /***************** output **********************************************************/
    /***********************************************************************************/

            /**** $_smarty instantiëren en initialiseren ********/  
            require("../smarty/mySmarty.inc.php");

            /**** functie om "menu" samen te stellen vanuit DB ********/
            require("../php_lib/menu.inc.php");

            /**** We kennen de variabelen toe ********/
            $_smarty->assign('inhoud',$_output);
            $_smarty->assign('commentaar',inlezen("Y_verwijderen_C.html"));
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