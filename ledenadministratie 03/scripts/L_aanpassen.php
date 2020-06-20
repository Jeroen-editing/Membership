<?php

    try {
        
        /********************** Initialisatie ************************************************/
        /*************************************************************************************/

        require_once("../code/initialisatie.inc.php");
        
        /**** is het script op een 'legale' manier opgestart ************/
        /**** is er een actie gedefiniëerd                   ************/
        /**** is de actie gelijk aan 4 ==> 'verwijderen'     ************/
        /**** is er een formulier (submit)                   ************/
        /****                                                ************/
        /**** anders ==> illegale toegang                    ************/

        if (! isset( $_SESSION["actie"]) ||
					 $_SESSION["actie"] != 4 || 
			! isset( $_POST["submit"])) {

			throw new Exception("Illegal access");
            
		}

        require("../code/inputUitpakken.inc.php");

        require("../code/useCreateSelect.inc.php");

        /********************** Verwerking formulier ******************************************/
        /**************************************************************************************/

        /**** Verwerk de inhoud v/h formulier **********/
        /**** de inhoud van $_POST['lidnr'] (super global) kopiëren naar de lokale parameter $_lidnr **********/
        $_lidnr = $_POST['lidnr'];

        /**** Query samenstellen **********/
        $_query = "SELECT * FROM v_leden WHERE d_lidnr = '$_lidnr'";

        /**** query naar DB sturen ************/
        $_result = $_PDO -> query("$_query");

        /**** resultaat van query verwerken ************/
        if ($_result -> rowCount() == 0) {
            /**** geen resultaat is DB inconsistency ************/

            throw new Exception("database inconsistency");

        }

        /**** vervolg enkel als er geen DB inconsistency is ************/
        while ($_row = $_result -> fetch(PDO::FETCH_ASSSOC)) {

            /**** formulier voor het geselecteerde lid ************/
            /**** welden ingevuld met de huidige waarden ************/
            /**** met een 'hidden field' voor het lidnr ************/
            	
            $_inhoud = "
                <h1>Aanpassen</h1>
                <form method='post' action='../scripts/L_data_aanpassen.php'>
                    <input type='hidden' name='lidnr' value='".$_row['d_lidnr']."'>
                    <label>Naam</label>
                        <input type='text' name='naam' value='".$_row['d_naam']."'>
                    <label>Voornaam</label>
                        <input type='text' name='voornaam' value='".$_row['d_voornaam']."'>
                    <br><br>";

                    
            /**** dropdown voor gender ************/
            $_inhoud.= "<label>Gender</label>".
                        dropDown("gender","t_gender","d_index", "d_mnemonic", 1, $_row['d_gender']);

            /**** dropdown voor soort lid ************/
            $_inhoud.= "<label >Soort lid</label>".
                        dropDown("soort","t_soort_lid","d_index", "d_mnemonic", 1, $_row['d_soortlid']);

            $_inhoud.= "
                    <br><br>
                    <label>Straat</label>
                        <input type='text' name='straat'value='".$_row['d_straat']."'>
                    <label>Nr & Extra</label>
                        <input type='text' name='nr' size='6' value='".$_row['d_nr']."'>
                        <input type='text' name='xtr' size='6' value='".$_row['d_Xtr']."'>
                    <br><br>
                    <label>Postcode</label>
                        <input type='text' name='postcode' size='8' value='".$_row['d_Postnummer']."'>
                    <label>Gemeente</label>
                        <input type='text' name='gemnaam'size='22' value='".$_row['d_GemeenteNaam']."'>
                    <br><br>
                    <label>Telefoon</label>
                        <input type='text' name='tel' size='12' value='".$_row['d_tel']."'>
                    <label>Mobiel</label>
                        <input type='text' name='mob' size='12' value='".$_row['d_mob']."'>
                    <label>E-mail</label>
                        <input type='text' name='mail' size='50' value='".$_row['d_mail']."'>
                    <br><br>
                        <input type='submit' name='submit_aanpassen' id='submit_aanpassen' value='Aanpassen'>
                </form>
                <br><hr><br>";

        }


        /*****************  output ***********************************************************************/
        /*************************************************************************************************/

        /**** menu initialiseren ********/ 
        $_menu = 1;
        
        /**** links commentaar veld initialiseren ********/ 
        $_commentaar = "L_data_aanpassen_C.html";


        require("../code/output.inc.php");
        /**** bevat alle code die nodig is om de output te genereren ************/
        /**** instantiëring v/h smarty-object                        ************/
        /**** toewijzen van de smarty variabelen                     ************/
        /**** koppeling met de gewenste template                     ************/
        
    } 
    
    catch (Exception $_e) {
        
        /**** exception handling functions ************/
        include("../php_lib/myExceptionHandling.inc.php"); 
        echo myExceptionHandling($_e,"../logs/error_log.csv");
    }

?>