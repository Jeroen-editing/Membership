<?php

    try {

        /********** Initialisatie ******************************************************/
        /*******************************************************************************/

        require_once("../code/initialisatie.inc.php");

				
		/**** is het script op een 'legale' manier opgestart ************/
		/**** is er een actie gedefiniëerd                   ************/
		/**** is de actie gelijk aan 1 ==> 'lezen'     	 ************/
		/**** is er een formulier (submit)                   ************/
		/****                                                ************/
		/**** anders ==> illegale toegang                    ************/
        
        if (! isset($_SESSION["actie"]) || 
                    $_SESSION["actie"] != 1 &&
                    $_SESSION["actie"] != 3 &&
                    $_SESSION["actie"] != 4 ||
            ! isset($_POST["submit"])) {

			/**** geen actie gedefiniëerd **********/
            throw new Exception("Illegal access");

		}


        /********** Verwerking *********************************************************/
        /*******************************************************************************/

        /**** Verwerk de inhoud v/h formulier **********/
        /**** de inhoud van $_POST (super global) naar lokale parameters kopiëren **********/
        require("../code/inputUitpakken.inc.php");
        
        /**** maak met de ingevoerde waarden de bijhorende query				************/
		/**** met de functie createSelect                   					************/
		/**** parameter 1 ==> de bijhorende tabel/view   						************/
		/**** parameter 2 ==> de lijst van ingevoerde waarden (array)           ************/
		/**** parameter 3 ==> de lijst van bijhorende velden ind de tabel/view  ************/

		require("../code/useCreateSelect.inc.php");
	
		/**** Query naar DB sturen ************/
        $_result = $_PDO -> query("$_query");
        
        /**** resultaat van query verwerken ************/
		if ($_result -> rowCount() > 0) {

            while ($_row = $_result -> fetch(PDO::FETCH_ASSOC)) {
                
                /**** toon alle gevonden leden ********/
                require("../code/toonData.inc.php");

        /**** Verschillende details voor elke andere actie :			    ************/
        /**** ------------------------------------------------------------- ************/
        /**** Lezen         ==> na elk lid een horizontale lijn zetten      ************/
        /**** -----                                                         ************/
		/**** Verwijderen   ==> na elk lid een confirmatie formulier,       ************/
        /**** -----------       met een verwijzing naar de volgende functie ************/
        /****                   (L_verwijder.php)                           ************/
        /****                   gevolgd door een horizontale lijn           ************/
        /****                                                               ************/
        /**** Aanpassen     ==> na elk lid een confirmatie formulier,       ************/
        /**** ---------         met een verwijzing naar de volgende functie ************/
        /****                   (L_aanpassen.php)                           ************/
        /****                   gevolgd door een horizontale lijn           ************/
        /**** ------------------------------------------------------------- ************/
        /**** Exception voor alle andere waarden (illegal actions) !        ************/

                switch ($_SESSION["actie"]) {

                    /**** lezen ********/
                    case '1':
                        break;

                    /**** verwijderen ********/
                    case 3:
                        $_inhoud =" 
                            <form method='post' action='L_verwijderen.php'>
                                <input type='hidden' name='lidnr' value='".$_row['d_lidnr']."'>
                                <label>Naam</label>
                                    <input type='text' name='naam' value='".$_row['d_naam']."'>
                                <label>Voornaam</label>
                                    <input type='text' name='voornaam' value='".$_row['d_voornaam']."'>
                                <br><br>
                                <input type='submit' name='submit_bev'  value='Verwijder'>";
                        break;

                    /**** aanpassen ********/
                    case 4:
                        $_inhoud.="
                            <form method='post' action='L_aanpassen.php'>
                                <input type='hidden' name='lidnr' value='".$_row['d_lidnr']."'>
                                <input class='knop_aanpassen' name='submit' type='submit' value='Pas aan'>
					        </form>";
                        break;

                    /**** alle andere waarden inclusief 2 (toevoegen) ********/
                    default:
                        throw new Exception("illegal action");
                        
                }

                $_inhoud.= "<br><hr><br>";

            }

        } else {

            /**** geen resultaten voor gegeven inhoud *********/
            $_inhoud = "
                    <br><br><br><br>
                    <div class=boodschap><h2>Geen records gevonden voor deze input.</h2></div>
                    <br><br><br><br>
                    <div class=boodschap><h2>Lid verwijderd.</h2></div>
                    <br><hr><br>";
                
        }

          
        /************ output ***********************************************************/
        /*******************************************************************************/ 

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

        /**** exception handling functions *********/ 
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>