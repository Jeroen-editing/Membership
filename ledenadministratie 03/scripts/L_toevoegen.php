<?php

	try {

		/************* Initialisatie ***************************************************/
		/*******************************************************************************/

		require_once("../code/initialisatie.inc.php");
				
		/**** is het script op een 'legale' manier opgestart ************/
		/**** is er een actie gedefiniëerd                   ************/
		/**** is de actie gelijk aan 2 ==> 'toevoegen'     	 ************/
		/**** is er een formulier (submit)                   ************/
		/****                                                ************/
		/**** anders ==> illegale toegang                    ************/

		if (! isset( $_SESSION["actie"]) ||
					 $_SESSION["actie"] != 2 || 
			! isset( $_POST["submit"])) {

			/**** geen actie gedefiniëerd **********/
            throw new Exception("illegal access");

		}

		/********************** Verwerking formulier ***********************************/
		/*******************************************************************************/

		/**** Verwerk de inhoud v/h formulier **********/
		require("../code/inputUitpakken.inc.php");

		$_gemeentePK = PK_t_gemeente($_postcode, $_gemeenteNaam);

		/************* Consistancy checks **********************************************/
		/*******************************************************************************/
		
		/**** nakijken of 'nieuw lid' al bestaat 								********/
		/**** met de functie createSelect                   					********/
		/**** parameter 1 ==> de bijhorende tabel/view   						********/
		/**** parameter 2 ==> de lijst van ingevoerde waarden (array)           ********/
		/**** parameter 3 ==> de lijst van bijhorende velden ind de tabel/view  ********/

		require("../code/useCreateSelect.inc.php");
	
		/**** Query naar DB sturen ************/
		$_result = $_PDO -> query("$_query");

		/**** resultaat van query verwerken ************/
		if ($_result -> rowCount() > 0) {

		/**** lid bestaat reeds ************/
			/**** melden dat lid al bestaat ************/
			$_inhoud = "<br><br><h2> Lid is al ingevoerd!</h2><br><br>";	

		} else {

		/**** lid bestaat reeds ************/
		/**** insert Query opmaken **********/
		/**** pimary key word niet meegegeven ==> 'auto increment (a)' van tabel is geactiveerd ************/
			
			/**** Query samenstellen **********/
			$_query = " INSERT INTO t_leden (
							d_naam, d_voornaam, 
							d_straat, d_nr, d_xtr, d_gemeente, 
							d_tel, d_mob, d_mail,
							d_gender, d_soort)
						VALUES (
							'$_naam', '$_voornaam', 
							'$_straat', '$_nr', '$_xtr', '$_gemeentePK', 
							'$_telefoon', '$_mob', '$_mail',
							'$_gender', '$_soort');";
			
			/**** Query naar DB sturen ********/
			$_result = $_PDO -> query("$_query"); 

			/**** nieuw lid is toegevoegd ********/
			$_inhoud = "<br><br><br><br><br><br>
						<h2>Lid &nbsp;&nbsp;$_voornaam &nbsp;&nbsp;$_naam&nbsp;&nbsp;is toegevoegd</h2>
						<br><hr><br>";
			
		}
			
		
		/**************  output ********************************************************/
		/*******************************************************************************/  

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
	/**** exception handling functions ********/ 
	include("../php_lib/myExceptionHandling.inc.php"); 
	echo myExceptionHandling($_e,"../logs/error_log.csv");
	}

?>