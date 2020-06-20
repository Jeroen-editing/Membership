<?php

    try {

        /****************** Initialisatie **********************************************/
        /*******************************************************************************/

        require_once("../code/initialisatie.inc.php");
				
		/**** is het script op een 'legale' manier opgestart ************/
		/**** is er een actie gedefiniëerd                   ************/
		/**** is de actie gelijk aan 3 ==> 'verwijderen'     ************/
		/**** is er een formulier (submit)                   ************/
		/****                                                ************/
		/**** anders ==> illegale toegang                    ************/

        if (! isset($_SESSION["actie"]) || 
                    $_SESSION["actie"] != 3 ||
            ! isset($_POST["submit-bev"])) {

			/**** geen actie gedefiniëerd **********/
            throw new Exception("illegal access");

		}
          
        /***************** verwerking **************************************************/
        /*******************************************************************************/

        /**** input uitpakken ************/
        $_lidnr = $_POST['lidnr'];
        $_naam = $_POST['naam'];
        $_voornaam = $_POST['voornaam'];
            
        //**** Query samenstellen ***********/
        $_query = " DELETE FROM 
                        t_leden
                    WHERE 
                        d_lidnr = $_lidnr;";
                
        //**** Query naar DB sturen ***********/
        $_result = $_PDO -> query("$_query");

        /**** lid is verwijderd *********/
        $_inhoud = "
                <br><br><br><br>
                <div class=boodschap><h2>Lid $_voornaam $_naam is verwijderd.</h2></div>
                <br><hr><br>";
              
        
        /***************** output ******************************************************/
        /*******************************************************************************/
        
        /**** menu initialiseren ********/ 
        $_menu = 1;
        
        /**** links commentaar veld initialiseren ********/ 
        $_commentaar = 'L_verwijderen_C.html';


        require("../code/output.inc.php");
        /**** bevat alle code die nodig is om de output te genereren ************/
        /**** instantiëring v/h smarty-object                        ************/
        /**** toewijzen van de smarty variabelen                     ************/
        /**** koppeling met de gewenste template                     ************/

    }


    catch (Exception $_e) {

        /**** exception handling functions ***********/
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>