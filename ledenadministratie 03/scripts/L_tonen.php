<?php

    try {

        /********** Initialisatie ******************************************************/
        /*******************************************************************************/

        require_once("../code/initialisatie.inc.php");

				
		/**** is het script op een 'legale' manier opgestart ****/
		/**** is er een actie gedefiniëerd                   ****/
		/**** is de actie gelijk aan 1 ==> 'lezen'     	     ****/
		/**** is er een formulier (submit)                   ****/
		/****                                                ****/
        /**** anders ==> illegale toegang                    ****/
        
        if (! isset($_SESSION["actie"]) || 
                    $_SESSION["actie"] != 1 &&
                    $_SESSION["actie"] != 3 &&
                    $_SESSION["actie"] != 4 ||
            ! isset($_POST["submit"])) {

			/**** geen actie gedefiniëerd **********/
            throw new Exception("Illegal access");


		}


        /********** (Input en) verwerking **********************************************/
        /*******************************************************************************/

        /**** formulier klaar maken ********/
        if (! isset($_POST["submit"])) {
            $_output =" 
                <h1>Leden tonen</h1>
                <form method='post' action='$_srv'>
                    <label>Naam</label>
                        <input type='text' name='naam'>
                    <label>Voornaam</label>
                        <input type='text' name='voornaam'>
                    <label>Gender</label>
                    <br><hr>";
              
            /**** drop-down gender *******/
            $_output.= dropDown("gender","t_gender","d_index","d_mnemonic");
              
            $_output.="<label >Soort lid</label>";  
            /**** drop-down soort lid *******/ 
            $_output.= dropDown("soort","t_soort_lid","d_index","d_mnemonic");

            $_output.="
                    <label>Straat</label>
                        <input type=text name=straat>
                    <label>Nr+ Extra</label>
                        <input type=text name=nr size=3>
                        <input type=text name=xtr size=3>
                    <label>Postcode</label>
                        <input type=text name=postcode size=8>
                    <label>Gemeente</label>
                        <input type=text name=gemnaam>
                    <br><hr>
                    <label>Telefoon</label>
                        <input type=text name=tel size=10>
                    <label>Mobiel</label>
                        <input type=text name=mob size=10>
                    <label>E-mail</label>
                        <input type=text name=mail size=40>
                    <br><hr><br>
                    <input name=submit class=submit type=submit value=verzenden>
                </form>";
          
        } else {
            /**** inhoud formulier verwerken *********/

            /**** input uitpakken *********/
            $_naam = $_POST["naam"];
            $_voornaam = $_POST["voornaam"];
            $_straat = $_POST["straat"];
            $_nr = $_POST["nr"];
            $_xtr = $_POST["xtr"];
            $_telefoon = $_POST["tel"];
            $_gemeenteNaam = $_POST["gemnaam"];
            $_postcode = $_POST["postcode"];
            $_mob = $_POST["mob"];
            $_mail = $_POST["mail"];
            $_gender = $_POST["gender"];
            $_soort = $_POST["soort"];
                  
            /**** Query samenstellen *********/
            $_query = createSelect(
                        "v_leden", 
                        array($_naam, $_voornaam,
                                $_straat, $_nr, $_xtr, $_postcode, $_gemeenteNaam,
                                $_telefoon, $_mob, $_mail,
                                $_gender, $_soort), 
                                      
                        array('d_naam', 'd_voornaam',
                                'd_straat','d_nr','d_xtr','d_Postnummer', 'd_GemeenteNaam',
                                'd_tel','d_mob','d_mail',
                                'd_gender', 'd_soortlid'));

            /**** Query naar DB sturen *********/
            $_result = $_PDO -> query("$_query"); 
                
            /**** Resultaat van query verwerken *********/
            if ($_result -> rowCount() == 0) {

                $_output = "<div class=boodschap>
                				<p>
                					Geen records gevonden voor deze input
                				</p>
                			</div>";
                
            } else {

                while ($_row = $_result -> fetch(PDO::FETCH_ASSOC)) {

                $_output.=  
                    $_row['d_voornaam']." ".
                    $_row['d_naam'].
                    "<br><br>".
                    $_row['d_gender_mnem'].
                    " / " .
                    $_row['d_soortlid_mnem']. 
                    "<br><br>".
                    $_row['d_straat']."&nbsp;&nbsp;".
                    $_row['d_nr']."&nbsp;&nbsp;".
                    $_row['d_xtr'].
                    "<br>".
                    $_row['d_postnummer']."&nbsp;&nbsp;". 
                    $_row['d_gemeenteNaam']. 
                    "<br><br>". 
                    "Tel : ".$_row['d_tel'].
                    "<br>".
                    "Mob : ".$_row['d_mob'].
                    "<br><br>". 
                    "Mail : ".$_row['d_mail'].
                    "<br><br><hr><br>";
                }
            }
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